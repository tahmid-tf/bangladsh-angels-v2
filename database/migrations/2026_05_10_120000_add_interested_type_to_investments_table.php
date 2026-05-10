<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Add `interested` alongside existing `invest` (and commit/review).
     * Does not rewrite existing rows — both types remain valid.
     */
    public function up(): void
    {
        $driver = Schema::getConnection()->getDriverName();

        if ($driver === 'mysql') {
            DB::statement("ALTER TABLE investments MODIFY COLUMN type ENUM('interested', 'invest', 'commit', 'review') NOT NULL");
        }
    }

    public function down(): void
    {
        $driver = Schema::getConnection()->getDriverName();

        if ($driver === 'mysql') {
            DB::table('investments')->where('type', 'interested')->update(['type' => 'invest']);
            DB::statement("ALTER TABLE investments MODIFY COLUMN type ENUM('invest', 'commit', 'review') NOT NULL");
        }
    }
};
