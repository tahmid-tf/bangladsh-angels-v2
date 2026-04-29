<?php

namespace Database\Seeders;

use App\Models\WhatWeDoCard;
use Illuminate\Database\Seeder;

class WhatWeDoCardSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            [
                'slug' => WhatWeDoCard::SLUG_BWIN,
                'title' => 'BWIN',
                'description' => "Bangladesh Women Investors Network (BWIN) is Bangladesh's first women-led angel investing network, operating as a sister chapter of BAN. With a gender-lens approach, BWIN supports pre-seed to seed-stage startups while actively growing a diverse pipeline of women investors and entrepreneurs.",
                'learn_more_label' => 'Learn more',
                'learn_more_link' => '/deckvue',
                'action_label' => 'Book a call',
                'action_link' => 'https://calendar.google.com/calendar/u/0/appointments/schedules/AcZssZ1oFoHy0m9As4PtSfm4Ee-nVyoZRNNyZ38doHCWpVwDfo5u3qxnesRT_LqD_Fv5nUlbE3EvxyYN',
                'sort_order' => 1,
            ],
            [
                'slug' => 'angel-academy',
                'title' => 'Angel Academy',
                'description' => 'Angel Academy helps aspiring and active angels learn investment fundamentals, portfolio strategy, and startup evaluation through practical sessions led by experienced members.',
                'learn_more_label' => 'Learn more',
                'learn_more_link' => '/angel-academy',
                'action_label' => 'Book a demo',
                'action_link' => 'https://calendar.google.com/calendar/u/0/appointments/schedules/AcZssZ1oFoHy0m9As4PtSfm4Ee-nVyoZRNNyZ38doHCWpVwDfo5u3qxnesRT_LqD_Fv5nUlbE3EvxyYN',
                'sort_order' => 2,
            ],
            [
                'slug' => 'showcases',
                'title' => 'Showcases',
                'description' => 'Our startup showcases connect vetted founders with BAN members, creating direct opportunities for live pitches, diligence conversations, and investments.',
                'sort_order' => 3,
            ],
        ];

        foreach ($rows as $row) {
            WhatWeDoCard::query()->updateOrCreate(
                ['slug' => $row['slug']],
                [
                    'title' => $row['title'],
                    'description' => $row['description'],
                    'learn_more_label' => $row['learn_more_label'] ?? null,
                    'learn_more_link' => $row['learn_more_link'] ?? null,
                    'action_label' => $row['action_label'] ?? null,
                    'action_link' => $row['action_link'] ?? null,
                    'sort_order' => $row['sort_order'],
                ]
            );
        }
    }
}
