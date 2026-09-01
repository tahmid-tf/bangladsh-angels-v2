<?php

namespace Tests\Feature;

use App\Models\Deal;
use App\Models\InvestorInvestment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InvestorInvestmentFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_update_read_and_delete_an_investment(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $investor = User::factory()->create(['role' => 'investor']);
        $startup = $this->createDeal($admin, 'Atlas Health');

        $createResponse = $this->actingAs($admin)->post(route('admin.investor-investments.store'), [
            'investor_id' => $investor->id,
            'deal_id' => $startup->id,
            'amount' => '25000.50',
            'currency' => 'usd',
            'completed_at' => now()->subDay()->toDateString(),
        ]);

        $investment = InvestorInvestment::firstOrFail();
        $createResponse->assertRedirect(route('admin.investor-investments.index'));
        $this->assertDatabaseHas('investor_investments', [
            'investor_id' => $investor->id,
            'deal_id' => $startup->id,
            'investor_name' => $investor->name,
            'investor_email' => $investor->email,
            'startup_name' => 'Atlas Health',
            'currency' => 'USD',
        ]);

        $this->get(route('admin.investor-investments.show', $investment))
            ->assertOk()
            ->assertSee($investor->email)
            ->assertSee('Atlas Health');

        $this->put(route('admin.investor-investments.update', $investment), [
            'investor_id' => $investor->id,
            'deal_id' => $startup->id,
            'amount' => '30000',
            'currency' => 'BDT',
            'completed_at' => now()->toDateString(),
        ])->assertRedirect(route('admin.investor-investments.show', $investment));

        $this->assertDatabaseHas('investor_investments', [
            'id' => $investment->id,
            'amount' => 30000,
            'currency' => 'BDT',
        ]);

        $this->delete(route('admin.investor-investments.destroy', $investment))
            ->assertRedirect(route('admin.investor-investments.index'));
        $this->assertDatabaseMissing('investor_investments', ['id' => $investment->id]);
    }

    public function test_autocomplete_returns_existing_investors_and_startups(): void
    {
        $admin = User::factory()->create(['role' => 'admin', 'name' => 'Admin Person']);
        $investor = User::factory()->create(['role' => 'investor', 'name' => 'Nadia Investor']);
        $this->createDeal($admin, 'Green Growth Labs');

        $this->actingAs($admin)
            ->getJson(route('admin.investor-investments.suggestions', ['field' => 'name', 'q' => 'Nadia']))
            ->assertOk()
            ->assertJsonPath('data.0.id', $investor->id)
            ->assertJsonPath('data.0.email', $investor->email);

        $this->getJson(route('admin.investor-investments.suggestions', ['field' => 'startup', 'q' => 'Green']))
            ->assertOk()
            ->assertJsonPath('data.0.title', 'Green Growth Labs');
    }

    public function test_investor_dashboard_only_displays_the_authenticated_investors_records(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $investor = User::factory()->create(['role' => 'investor']);
        $otherInvestor = User::factory()->create(['role' => 'investor']);
        $ownStartup = $this->createDeal($admin, 'Own Portfolio Company');
        $otherStartup = $this->createDeal($admin, 'Another Investor Company');

        $this->createInvestment($investor, $ownStartup, $admin);
        $this->createInvestment($otherInvestor, $otherStartup, $admin);

        $this->actingAs($investor)
            ->get(route('investor.dashboard'))
            ->assertOk()
            ->assertSee('Own Portfolio Company')
            ->assertDontSee('Another Investor Company');

        $this->actingAs($admin)
            ->get(route('investor.dashboard'))
            ->assertForbidden();
    }

    public function test_non_admin_cannot_manage_investment_records(): void
    {
        $investor = User::factory()->create(['role' => 'investor']);

        $this->actingAs($investor)
            ->get(route('admin.investor-investments.index'))
            ->assertForbidden();
    }

    private function createDeal(User $admin, string $title): Deal
    {
        return Deal::query()->create([
            'title' => $title,
            'description' => 'Test startup',
            'type' => 'invest',
            'created_by' => $admin->id,
            'status' => 'active',
            'slug' => str($title)->slug()->toString(),
        ]);
    }

    private function createInvestment(User $investor, Deal $startup, User $admin): InvestorInvestment
    {
        return InvestorInvestment::query()->create([
            'investor_id' => $investor->id,
            'deal_id' => $startup->id,
            'investor_name' => $investor->name,
            'investor_email' => $investor->email,
            'startup_name' => $startup->title,
            'amount' => 10000,
            'currency' => 'USD',
            'completed_at' => now()->subDay(),
            'created_by' => $admin->id,
            'updated_by' => $admin->id,
        ]);
    }
}
