<?php

namespace Tests\Feature;

use App\Models\Deal;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DealPortfolioListingTest extends TestCase
{
    use RefreshDatabase;

    public function test_an_invest_deal_can_appear_in_both_admin_sections(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $deal = $this->createDeal($admin, [
            'type' => 'invest',
            'is_portfolio' => true,
        ]);

        $this->actingAs($admin)
            ->get(route('admin.deals.invest'))
            ->assertOk()
            ->assertSee($deal->title);

        $this->actingAs($admin)
            ->get(route('admin.deals.portfolio'))
            ->assertOk()
            ->assertSee($deal->title);

        $this->actingAs($admin)
            ->get(route('admin.deals.invest-portfolio'))
            ->assertOk()
            ->assertSee('Investment &amp; Portfolio', false)
            ->assertSee($deal->title);

        $this->actingAs($admin)
            ->get(route('startups'))
            ->assertOk()
            ->assertSee($deal->title);

        $this->get(route('portfolio'))
            ->assertOk()
            ->assertSee($deal->title);
    }

    public function test_legacy_portfolio_only_deals_remain_in_the_portfolio(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $legacyPortfolioDeal = $this->createDeal($admin, ['type' => 'portfolio']);

        $this->actingAs($admin)
            ->get(route('admin.deals.portfolio'))
            ->assertOk()
            ->assertSee($legacyPortfolioDeal->title);

        $this->actingAs($admin)
            ->get(route('admin.deals.invest-portfolio'))
            ->assertOk()
            ->assertDontSee($legacyPortfolioDeal->title);
    }

    public function test_admin_can_enable_and_disable_the_portfolio_listing(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $deal = $this->createDeal($admin);

        $payload = [
            'title' => $deal->title,
            'sector' => $deal->sector,
            'type' => 'invest',
            'description' => $deal->description,
            'status' => 'active',
            'is_portfolio' => '1',
        ];

        $this->actingAs($admin)
            ->post(route('update.deal', $deal), $payload)
            ->assertRedirect(route('admin.deals'));

        $this->assertTrue($deal->fresh()->is_portfolio);

        $payload['is_portfolio'] = '0';

        $this->actingAs($admin)
            ->post(route('update.deal', $deal), $payload)
            ->assertRedirect(route('admin.deals'));

        $this->assertFalse($deal->fresh()->is_portfolio);
    }

    public function test_filtered_admin_deal_tabs_render_working_search_and_edit_actions(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $deals = [
            'invest' => $this->createDeal($admin, [
                'title' => 'Invest tab deal',
                'type' => 'invest',
            ]),
            'commit' => $this->createDeal($admin, [
                'title' => 'Commit tab deal',
                'type' => 'commit',
            ]),
            'review' => $this->createDeal($admin, [
                'title' => 'Review tab deal',
                'type' => 'review',
            ]),
            'portfolio' => $this->createDeal($admin, [
                'title' => 'Portfolio tab deal',
                'type' => 'portfolio',
            ]),
            'invest-portfolio' => $this->createDeal($admin, [
                'title' => 'Invest portfolio tab deal',
                'type' => 'invest',
                'is_portfolio' => true,
            ]),
        ];

        foreach ($deals as $tab => $deal) {
            $response = $this->actingAs($admin)->get(route("admin.deals.{$tab}"));

            $response->assertOk()
                ->assertSee('wire:model.defer="search"', false)
                ->assertSee(route('edit.deal', $deal), false)
                ->assertSee($deal->title);

            foreach ($deals as $otherTab => $otherDeal) {
                $isIncludedInCurrentTab = ($tab === 'invest' && $otherTab === 'invest-portfolio')
                    || ($tab === 'portfolio' && $otherTab === 'invest-portfolio');

                if ($otherTab !== $tab && ! $isIncludedInCurrentTab) {
                    $response->assertDontSee($otherDeal->title);
                }
            }
        }
    }

    private function createDeal(User $creator, array $attributes = []): Deal
    {
        return Deal::create(array_merge([
            'title' => 'Dual-listed startup',
            'slug' => 'dual-listed-startup-'.uniqid(),
            'description' => 'A startup available as an investment and portfolio company.',
            'sector' => 'Technology',
            'type' => 'invest',
            'is_portfolio' => false,
            'status' => 'active',
            'created_by' => $creator->id,
        ], $attributes));
    }
}
