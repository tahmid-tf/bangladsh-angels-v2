<?php

namespace App\Http\Controllers;

use App\Models\Commit;
use App\Models\Deal;
use App\Models\Investment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvestmentController extends Controller
{
    public function __invoke(Request $request)
    {
        $q = trim((string) $request->string('q'));
        $typeFilter = $request->string('type')->toString();
        $statusFilter = $request->string('status')->toString();
        $stageFilter = $request->string('stage')->toString();
        $sort = $request->string('sort')->toString() ?: 'latest_activity';

        $dealsQuery = Deal::query()
            ->withCount([
                'investments as invest_count' => fn ($query) => $query->where('type', 'invest'),
                'investments as review_count' => fn ($query) => $query->where('type', 'review'),
                'commits as commit_count',
            ])
            ->withMax('investments', 'created_at')
            ->withMax('commits', 'created_at')
            ->when($q !== '', function ($query) use ($q) {
                $query->where(function ($innerQuery) use ($q) {
                    $innerQuery->where('title', 'like', "%{$q}%")
                        ->orWhere('sector', 'like', "%{$q}%")
                        ->orWhere('description', 'like', "%{$q}%")
                        ->orWhereHas('investments.user', function ($userQuery) use ($q) {
                            $userQuery->where('name', 'like', "%{$q}%")
                                ->orWhere('email', 'like', "%{$q}%");
                        })
                        ->orWhereHas('commits.user', function ($userQuery) use ($q) {
                            $userQuery->where('name', 'like', "%{$q}%")
                                ->orWhere('email', 'like', "%{$q}%");
                        });
                });
            })
            ->when(in_array($typeFilter, ['invest', 'commit', 'review'], true), function ($query) use ($typeFilter) {
                if ($typeFilter === 'commit') {
                    $query->whereHas('commits');
                } else {
                    $query->whereHas('investments', fn ($investmentQuery) => $investmentQuery->where('type', $typeFilter));
                }
            })
            ->when($statusFilter !== '', fn ($query) => $query->where('status', $statusFilter))
            ->when($stageFilter !== '', fn ($query) => $query->where('investment_stage', $stageFilter));

        if ($sort === 'most_investments') {
            $dealsQuery->orderByRaw('(
                (SELECT COUNT(*) FROM investments WHERE investments.deal_id = deals.id AND investments.type = ?)
                + (SELECT COUNT(*) FROM investments WHERE investments.deal_id = deals.id AND investments.type = ?)
                + (SELECT COUNT(*) FROM commits WHERE commits.deal_id = deals.id)
            ) DESC', ['invest', 'review']);
        } elseif ($sort === 'title_asc') {
            $dealsQuery->orderBy('title');
        } elseif ($sort === 'title_desc') {
            $dealsQuery->orderByDesc('title');
        } else {
            $driver = DB::connection()->getDriverName();
            if (in_array($driver, ['mysql', 'pgsql'], true)) {
                $dealsQuery->orderByRaw('GREATEST(
                    COALESCE((SELECT MAX(created_at) FROM investments WHERE investments.deal_id = deals.id), ?),
                    COALESCE((SELECT MAX(created_at) FROM commits WHERE commits.deal_id = deals.id), ?)
                ) DESC', ['1970-01-01 00:00:00', '1970-01-01 00:00:00']);
            } else {
                // SQLite etc.: approximate ordering (commits-only activity may sort slightly late)
                $dealsQuery->orderByDesc('investments_max_created_at');
            }
        }

        $deals = $dealsQuery
            ->paginate(20)
            ->withQueryString();

        $availableStatuses = Deal::query()
            ->select('status')
            ->whereNotNull('status')
            ->distinct()
            ->orderBy('status')
            ->pluck('status');

        $availableStages = Deal::query()
            ->select('investment_stage')
            ->whereNotNull('investment_stage')
            ->distinct()
            ->orderBy('investment_stage')
            ->pluck('investment_stage');

        return view('admin.investments.index', [
            'deals' => $deals,
            'availableStatuses' => $availableStatuses,
            'availableStages' => $availableStages,
            'filters' => [
                'q' => $q,
                'type' => $typeFilter,
                'status' => $statusFilter,
                'stage' => $stageFilter,
                'sort' => $sort,
            ],
        ]);
    }

    public function invest(Request $request, Deal $deal)
    {
        $validated = $request->validate([
            'deal_id' => 'required|exists:deals,id',
            'user_id' => 'required|exists:users,id',
            'type' => 'nullable|string', // Handles Added Buttons
        ]);

        $requestedType = $request->input('type');

        // Join WhatsApp / review signal — always stored on investments as type "review"
        if ($requestedType === 'review') {
            Investment::create([
                'deal_id' => $request->deal_id,
                'user_id' => $request->user_id,
                'type' => 'review',
            ]);

            return redirect()->to($deal->groupchat_invite_link);
        }

        // Commit deals: recorded commitments live in `commits` only (amount/deadline), not as investments rows
        if ($deal->type === 'commit') {
            if (Commit::where('deal_id', $deal->id)->where('user_id', $request->user_id)->exists()) {
                return redirect()->route('deal.view', $deal)->with('error', 'You have already committed to this deal.');
            }

            return redirect()->route('deal.commit.form', $deal->id);
        }

        // Express interest (invest deals) and other deal types: one investments row per user per deal
        $existingInvestment = Investment::where('user_id', $request->user_id)
            ->where('deal_id', $request->deal_id)
            ->first();

        if ($existingInvestment) {
            if ($deal->type == 'review') {
                return redirect()->to($deal->groupchat_invite_link);
            }

            return back()->with('error', 'You have already recorded activity for this deal.');
        }

        Investment::create([
            'deal_id' => $request->deal_id,
            'user_id' => $request->user_id,
            'type' => $requestedType ?: $deal->type,
        ]);

        if ($deal->type == 'invest') {
            if ($deal->invest_link) {
                return redirect()->to($deal->invest_link);
            } else {
                return back()->with('success', 'Investment recorded! You will receive investment details from the lead investment analyst shortly');
            }
        } elseif ($deal->type == 'review') {
            return redirect()->to($deal->groupchat_invite_link);
        } elseif ($deal->type == 'portfolio') {
            return redirect()->route('deal.view', $deal);
        }

        return back()->with('success', 'Investment recorded successfully!');
    }

    public function commitForm(Request $request, Deal $deal)
    {
        return view('deals.commitForm', compact('deal'));
    }

    public function commit(Request $request, Deal $deal)
    {
        $validated = $request->validate([
            'deal_id' => 'required|exists:deals,id',
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|integer',
            'deadline' => 'required|date',
        ]);

        // Check if the user has already invested in the deal
        $existingCommit = Commit::where('user_id', $request->user_id)
            ->where('deal_id', $request->deal_id)
            ->first();

        if ($existingCommit) {
            return redirect()->route('deal.view', $deal)->with('error', 'You have already committed to this deal.');
        }

        $newCommit = Commit::create([
            'deal_id' => $deal->id,
            'user_id' => auth()->user()->id,
            'amount' => $request->amount,
            'deadline' => $request->deadline,
        ]);
        if ($deal->commit_link) {
            return redirect()->to($deal->commit_link);
        } else {
            return redirect()->route('deal.view', $deal)->with('success', 'Commitment recorded successfully!');
        }
    }

    public function viewInvest()
    {
        $investments = Investment::with(['deal', 'user'])
            ->where('type', 'invest')
            ->orderByDesc('created_at')
            ->get();

        return view('admin.investments.invest_index', compact('investments'));
    }

    public function viewCommit()
    {
        $commits = Commit::with(['deal', 'user'])
            ->orderByDesc('created_at')
            ->get();

        return view('admin.investments.commit_index', compact('commits'));
    }

    public function viewReview()
    {
        $investments = Investment::with(['deal', 'user'])
            ->where('type', 'review')
            ->orderByDesc('created_at')
            ->get();

        return view('admin.investments.review_index', compact('investments'));
    }
}
