<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * If an older migration removed `invest` from the enum, add it back so both
 * `interested` and `invest` exist on investments.type.
 */
return new class extends Migration
{
    public function up(): void
    {
        $driver = Schema::getConnection()->getDriverName();

        if ($driver !== 'mysql') {
            return;
        }

        $column = DB::selectOne(
            'SELECT COLUMN_TYPE AS col_type FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = ? AND COLUMN_NAME = ?',
            ['investments', 'type']
        );

        if (! $column || ! isset($column->col_type)) {
            return;
        }

        $def = strtolower((string) $column->col_type);
        if (str_contains($def, 'invest') && str_contains($def, 'interested')) {
            return;
        }

        DB::statement("ALTER TABLE investments MODIFY COLUMN type ENUM('interested', 'invest', 'commit', 'review') NOT NULL");
    }

    public function down(): void
    {
        // no-op: do not shrink enum after repair
    }
};
