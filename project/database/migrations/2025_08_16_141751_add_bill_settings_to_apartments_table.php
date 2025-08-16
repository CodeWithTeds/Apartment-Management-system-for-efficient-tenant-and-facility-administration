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
        Schema::table('apartments', function (Blueprint $table) {
            $table->boolean('water_bill_enabled')->default(false)->after('short_term_minimum_stay');
            $table->boolean('electric_bill_enabled')->default(false)->after('water_bill_enabled');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('apartments', function (Blueprint $table) {
            $table->dropColumn(['water_bill_enabled', 'electric_bill_enabled']);
        });
    }
};
