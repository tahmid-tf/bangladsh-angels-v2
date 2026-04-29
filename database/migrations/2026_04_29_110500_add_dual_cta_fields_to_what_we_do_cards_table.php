<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('what_we_do_cards', function (Blueprint $table) {
            $table->string('learn_more_label', 120)->nullable()->after('cta_link');
            $table->string('learn_more_link', 2048)->nullable()->after('learn_more_label');
            $table->string('action_label', 120)->nullable()->after('learn_more_link');
            $table->string('action_link', 2048)->nullable()->after('action_label');
        });

        DB::table('what_we_do_cards')
            ->whereNotNull('cta_link')
            ->update([
                'learn_more_label' => 'Learn more',
                'learn_more_link' => DB::raw('cta_link'),
            ]);

        DB::table('what_we_do_cards')
            ->where('slug', 'angel-academy')
            ->update([
                'learn_more_label' => DB::raw("COALESCE(learn_more_label, 'Learn more')"),
                'learn_more_link' => DB::raw("COALESCE(learn_more_link, '/angel-academy')"),
                'action_label' => DB::raw("COALESCE(action_label, 'Book a demo')"),
                'action_link' => DB::raw("COALESCE(action_link, 'https://calendar.google.com/calendar/u/0/appointments/schedules/AcZssZ1oFoHy0m9As4PtSfm4Ee-nVyoZRNNyZ38doHCWpVwDfo5u3qxnesRT_LqD_Fv5nUlbE3EvxyYN')"),
            ]);

        DB::table('what_we_do_cards')
            ->where('slug', 'bwin')
            ->update([
                'learn_more_label' => DB::raw("COALESCE(learn_more_label, 'Learn more')"),
                'learn_more_link' => DB::raw("COALESCE(learn_more_link, '/deckvue')"),
                'action_label' => DB::raw("COALESCE(action_label, 'Book a call')"),
                'action_link' => DB::raw("COALESCE(action_link, 'https://calendar.google.com/calendar/u/0/appointments/schedules/AcZssZ1oFoHy0m9As4PtSfm4Ee-nVyoZRNNyZ38doHCWpVwDfo5u3qxnesRT_LqD_Fv5nUlbE3EvxyYN')"),
            ]);
    }

    public function down(): void
    {
        Schema::table('what_we_do_cards', function (Blueprint $table) {
            $table->dropColumn([
                'learn_more_label',
                'learn_more_link',
                'action_label',
                'action_link',
            ]);
        });
    }
};
