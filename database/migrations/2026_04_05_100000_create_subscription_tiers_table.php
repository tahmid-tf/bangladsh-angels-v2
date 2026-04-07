<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('subscription_tiers', function (Blueprint $table) {
            $table->id();
            $table->string('slug', 32)->unique();
            $table->string('name', 100);
            $table->decimal('price_yearly', 10, 2);
            $table->boolean('is_active')->default(true);
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->boolean('is_highlighted')->default(false);
            $table->text('features_included')->nullable();
            $table->text('features_excluded')->nullable();
            $table->timestamps();
        });

        $now = now();
        $rows = [
            [
                'slug' => 'core',
                'name' => 'Core',
                'price_yearly' => 399.00,
                'is_active' => true,
                'sort_order' => 1,
                'is_highlighted' => false,
                'features_included' => "Complete deal access\nData room access (with approval)\nActive deal participation\nInvestment capabilities",
                'features_excluded' => "Portfolio monitoring\nFull access to dataroom\nFull access of deal flows & showcases",
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'slug' => 'advanced',
                'name' => 'Advanced',
                'price_yearly' => 599.00,
                'is_active' => true,
                'sort_order' => 2,
                'is_highlighted' => true,
                'features_included' => "Complete Deal Access\nFull Access to Data Room\nActive Deal Participation\nInvestment Capabilities\nPortfolio Monitoring\nFull access of Deal Flows & Showcases",
                'features_excluded' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'slug' => 'institutional',
                'name' => 'Institutional',
                'price_yearly' => 999.00,
                'is_active' => true,
                'sort_order' => 3,
                'is_highlighted' => false,
                'features_included' => "Complete Deal Access\nFull Access to Data Room\nActive Deal Participation\nInvestment Capabilities\nPortfolio Monitoring\nFull access of Deal Flows & Showcases\n3-4 Additional Account access",
                'features_excluded' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        DB::table('subscription_tiers')->insert($rows);
    }

    public function down(): void
    {
        Schema::dropIfExists('subscription_tiers');
    }
};
