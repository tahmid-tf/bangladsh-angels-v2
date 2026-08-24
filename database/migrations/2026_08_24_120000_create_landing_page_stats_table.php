<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('landing_page_stats', function (Blueprint $table) {
            $table->id();
            $table->string('value', 40);
            $table->string('label', 120);
            $table->unsignedTinyInteger('sort_order');
            $table->timestamps();
        });

        $now = now();

        DB::table('landing_page_stats')->insert([
            ['value' => '500+', 'label' => "Angel\ninvestors", 'sort_order' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['value' => '$12M+', 'label' => 'Capital facilitated', 'sort_order' => 2, 'created_at' => $now, 'updated_at' => $now],
            ['value' => '51', 'label' => 'Portfolio companies', 'sort_order' => 3, 'created_at' => $now, 'updated_at' => $now],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('landing_page_stats');
    }
};
