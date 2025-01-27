<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('deals', function (Blueprint $table) {
            $table->text('groupchat_invite_link')->nullable();
            $table->text('commit_link')->nullable();
            $table->text('invest_link')->nullable();
            $table->boolean('public_profile')->default(false)->nullable();
            $table->dropColumn('action_link');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('deals', function (Blueprint $table) {
            $table->dropColumn([
                'groupchat_invite_link',
                'commit_link',
                'invest_link',
                'public_profile'
            ]);
            $table->text('action_link')->nullable();
        });
    }
};
