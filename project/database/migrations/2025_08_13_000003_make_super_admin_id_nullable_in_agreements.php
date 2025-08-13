<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('agreements', function (Blueprint $table) {
            // Drop the existing foreign key constraint before altering the column
            if (Schema::hasColumn('agreements', 'super_admin_id')) {
                $table->dropForeign(['super_admin_id']);
            }
        });

        // Make column nullable without requiring doctrine/dbal
        DB::statement('ALTER TABLE agreements MODIFY super_admin_id BIGINT UNSIGNED NULL');

        Schema::table('agreements', function (Blueprint $table) {
            $table->foreign('super_admin_id')->references('id')->on('super_admins')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('agreements', function (Blueprint $table) {
            $table->dropForeign(['super_admin_id']);
        });

        DB::statement('ALTER TABLE agreements MODIFY super_admin_id BIGINT UNSIGNED NOT NULL');

        Schema::table('agreements', function (Blueprint $table) {
            $table->foreign('super_admin_id')->references('id')->on('super_admins')->onDelete('cascade');
        });
    }
};


