<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $driver = Schema::getConnection()->getDriverName();

        if ($driver === 'mysql') {
            DB::statement("ALTER TABLE investments MODIFY COLUMN type ENUM('invest', 'commit', 'review', 'interested') NOT NULL");
        }

        DB::table('investments')->where('type', 'invest')->update(['type' => 'interested']);

        if ($driver === 'mysql') {
            DB::statement("ALTER TABLE investments MODIFY COLUMN type ENUM('interested', 'commit', 'review') NOT NULL");
        }
    }

    public function down(): void
    {
        $driver = Schema::getConnection()->getDriverName();

        if ($driver === 'mysql') {
            DB::statement("ALTER TABLE investments MODIFY COLUMN type ENUM('invest', 'commit', 'review', 'interested') NOT NULL");
        }

        DB::table('investments')->where('type', 'interested')->update(['type' => 'invest']);

        if ($driver === 'mysql') {
            DB::statement("ALTER TABLE investments MODIFY COLUMN type ENUM('invest', 'commit', 'review') NOT NULL");
        }
    }
};
