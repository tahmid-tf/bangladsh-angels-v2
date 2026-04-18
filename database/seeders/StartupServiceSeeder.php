<?php

namespace Database\Seeders;

use App\Models\StartupService;
use Illuminate\Database\Seeder;

class StartupServiceSeeder extends Seeder
{
    public function run(): void
    {
        if (StartupService::query()->exists()) {
            return;
        }

        StartupService::query()->create([
            'title' => 'Pre-seed Founder Services',
            'intro' => 'Hands-on help as you prepare to fundraise and scale: narrative, materials, and investor conversations.',
            'bullets' => [
                'Fundraising narrative and positioning',
                'Deck review and storytelling for investor meetings',
                'Monthly showcase and pitch preparation',
                'Office hours with operators and angels in the network',
            ],
            'footer_note' => 'Delivered as scoped packages; contact BAN for availability and pricing.',
            'link' => 'mailto:hello@bdangels.co?subject='.rawurlencode('Pre-seed Founder Services'),
            'cta_label' => 'Get in touch',
            'show_brochure_link' => true,
            'sort_order' => 1,
        ]);

        StartupService::query()->create([
            'title' => 'Legal Services',
            'intro' => 'Practical legal support for early-stage structures and transactions, coordinated with qualified counsel where required.',
            'bullets' => [
                'Company formation and cap table hygiene',
                'Founders agreements and employment basics',
                'Term sheet and SAFE / convertible note review',
                'Regulatory and compliance orientation for your sector',
            ],
            'footer_note' => 'Not legal advice as law firm representation; BAN can introduce counsel and structured legal packages.',
            'link' => 'mailto:hello@bdangels.co?subject='.rawurlencode('Legal Services inquiry'),
            'cta_label' => 'Get in touch',
            'show_brochure_link' => true,
            'sort_order' => 2,
        ]);
    }
}
