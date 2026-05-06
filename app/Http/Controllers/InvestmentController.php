<?php

namespace App\Http\Controllers;

use App\Models\Commit;
use App\Models\Deal;
use App\Models\Investment;
use App\Models\User;
use Illuminate\Http\Request;

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
                'investments as total_investments_count',
                'investments as invest_count' => fn ($query) => $query->where('type', 'invest'),
                'investments as commit_count' => fn ($query) => $query->where('type', 'commit'),
                'investments as review_count' => fn ($query) => $query->where('type', 'review'),
            ])
            ->withMax('investments', 'created_at')
            ->when($q !== '', function ($query) use ($q) {
                $query->where(function ($innerQuery) use ($q) {
                    $innerQuery->where('title', 'like', "%{$q}%")
                        ->orWhere('sector', 'like', "%{$q}%")
                        ->orWhere('description', 'like', "%{$q}%")
                        ->orWhereHas('investments.user', function ($userQuery) use ($q) {
                            $userQuery->where('name', 'like', "%{$q}%")
                                ->orWhere('email', 'like', "%{$q}%");
                        });
                });
            })
            ->when(in_array($typeFilter, ['invest', 'commit', 'review'], true), function ($query) use ($typeFilter) {
                $query->whereHas('investments', fn ($investmentQuery) => $investmentQuery->where('type', $typeFilter));
            })
            ->when($statusFilter !== '', fn ($query) => $query->where('status', $statusFilter))
            ->when($stageFilter !== '', fn ($query) => $query->where('investment_stage', $stageFilter));

        if ($sort === 'most_investments') {
            $dealsQuery->orderByDesc('total_investments_count');
        } elseif ($sort === 'title_asc') {
            $dealsQuery->orderBy('title');
        } elseif ($sort === 'title_desc') {
            $dealsQuery->orderByDesc('title');
        } else {
            $dealsQuery->orderByDesc('investments_max_created_at');
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

        if (isset($request->type) && $request->type == 'review') {
            // Do not check if investment exists
        } else {
            // Check if the user has already invested in the deal
            $existingInvestment = Investment::where('user_id', $request->user_id)
                ->where('deal_id', $request->deal_id)
                ->first();

            if ($existingInvestment) {
                // Exception for Review Deals
                if ($deal->type == 'review') {
                    return redirect()->to($deal->groupchat_invite_link);
                }

                return back()->with('error', 'You have already invested in this deal.');
            }

        }

        // Create a new investment record
        Investment::create([
            'deal_id' => $request->deal_id,
            'user_id' => $request->user_id,
            'type' => (! $request->type) ? $deal->type : $request->type, // If a Type is defined in initial request, use that defined type as opposed to the native type of the investment
        ]);

        if (isset($request->type) && $request->type == 'review') {
            return redirect()->to($deal->groupchat_invite_link);
        }

        if ($deal->type == 'invest') {
            if ($deal->invest_link) {
                return redirect()->to($deal->invest_link);
            } else {
                return back()->with('success', 'Investment recorded! You will receive investment details from the lead investment analyst shortly');
            }
        } elseif ($deal->type == 'commit') {
            return redirect()->route('deal.commit.form', $deal->id);
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
        $investments = Investment::with('deal')->where('type', 'invest')->get();

        return view('admin.investments.invest_index', compact('investments'));
    }

    public function viewCommit()
    {
        $investments = Investment::with('deal')->where('type', 'commit')->get();

        return view('admin.investments.commit_index', compact('investments'));
    }

    public function viewReview()
    {
        $investments = Investment::with('deal')->where('type', 'review')->get();

        return view('admin.investments.review_index', compact('investments'));
    }
}
