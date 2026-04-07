<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\SubscriptionTier;
use App\Models\User;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function index()
    {
        abort_unless(auth()->user()?->isAdmin(), 403);

        $subscriptions = Subscription::with(['user', 'payment'])
            ->whereHas('user', function ($query) {
                $query->where('account_status', '!=', 'free');
            })
            ->get();

        $usersWithoutSubscriptions = User::where('account_status', '!=', 'free')
            ->whereNotIn('id', $subscriptions->pluck('user_id'))
            ->get();

        $tiers = SubscriptionTier::ordered()->get();

        return view('admin.subscriptions.index', compact('subscriptions', 'usersWithoutSubscriptions', 'tiers'));
    }

    public function updateTiers(Request $request)
    {
        abort_unless(auth()->user()?->isAdmin(), 403);

        $tierIds = SubscriptionTier::query()->pluck('id')->all();

        $validated = $request->validate([
            'tiers' => ['required', 'array'],
            'tiers.*.name' => ['required', 'string', 'max:100'],
            'tiers.*.price_yearly' => ['required', 'numeric', 'min:0', 'max:999999.99'],
            'tiers.*.is_active' => ['nullable', 'boolean'],
            'tiers.*.sort_order' => ['required', 'integer', 'min:0', 'max:65535'],
            'tiers.*.is_highlighted' => ['nullable', 'boolean'],
            'tiers.*.features_included' => ['nullable', 'string', 'max:20000'],
            'tiers.*.features_excluded' => ['nullable', 'string', 'max:20000'],
        ]);

        $submittedIds = array_map('intval', array_keys($validated['tiers']));
        sort($submittedIds);
        $expectedIds = $tierIds;
        sort($expectedIds);
        if ($submittedIds !== $expectedIds) {
            return back()->withErrors(['tiers' => 'All membership tiers must be saved together.'])->withInput();
        }

        foreach ($validated['tiers'] as $id => $row) {
            if (! in_array((int) $id, $tierIds, true)) {
                abort(400, 'Invalid tier id.');
            }

            SubscriptionTier::query()->whereKey($id)->update([
                'name' => $row['name'],
                'price_yearly' => $row['price_yearly'],
                'is_active' => $request->boolean("tiers.{$id}.is_active"),
                'sort_order' => $row['sort_order'],
                'is_highlighted' => $request->boolean("tiers.{$id}.is_highlighted"),
                'features_included' => $row['features_included'] ?? null,
                'features_excluded' => $row['features_excluded'] ?? null,
            ]);
        }

        // At most one “popular” badge — last submitted wins; normalize to single highlight
        $highlighted = SubscriptionTier::query()->where('is_highlighted', true)->orderBy('id')->get();
        if ($highlighted->count() > 1) {
            SubscriptionTier::query()->update(['is_highlighted' => false]);
            $keep = $highlighted->last();
            SubscriptionTier::query()->whereKey($keep->id)->update(['is_highlighted' => true]);
        }

        return redirect()->route('admin.subscriptions')->with('success', 'Subscription tiers and prices updated.');
    }
}
