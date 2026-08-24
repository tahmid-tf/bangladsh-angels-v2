<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('landing_program_cards', function (Blueprint $table) {
            $table->id();
            $table->string('eyebrow', 120);
            $table->string('title');
            $table->text('description');
            $table->string('primary_label', 120);
            $table->string('primary_link', 2048);
            $table->string('secondary_label', 120)->nullable();
            $table->string('secondary_link', 2048)->nullable();
            $table->string('theme', 24)->default('white');
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();
        });

        $now = now();
        $bookingLink = 'https://calendar.google.com/calendar/u/0/appointments/schedules/AcZssZ1oFoHy0m9As4PtSfm4Ee-nVyoZRNNyZ38doHCWpVwDfo5u3qxnesRT_LqD_Fv5nUlbE3EvxyYN';

        DB::table('landing_program_cards')->insert([
            [
                'eyebrow' => 'Women-led investment',
                'title' => 'BWIN',
                'description' => 'Building a more diverse pipeline of investors and entrepreneurs across Bangladesh.',
                'primary_label' => 'Explore BWIN',
                'primary_link' => '/bwin',
                'secondary_label' => 'Book a call',
                'secondary_link' => $bookingLink,
                'theme' => 'blush',
                'sort_order' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'eyebrow' => 'Investor education',
                'title' => 'Angel Academy',
                'description' => 'Practical learning for aspiring and active angels—from first principles to investment committee.',
                'primary_label' => 'Visit Angel Academy',
                'primary_link' => '/angel-academy',
                'secondary_label' => 'Book a demo',
                'secondary_link' => $bookingLink,
                'theme' => 'dark',
                'sort_order' => 2,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'eyebrow' => 'AI-powered diligence',
                'title' => 'DeckVue',
                'description' => 'Turn pitch decks into structured, verified investment intelligence in minutes.',
                'primary_label' => 'Open DeckVue',
                'primary_link' => '/deckvue',
                'secondary_label' => null,
                'secondary_link' => null,
                'theme' => 'mint',
                'sort_order' => 3,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('landing_program_cards');
    }
};
