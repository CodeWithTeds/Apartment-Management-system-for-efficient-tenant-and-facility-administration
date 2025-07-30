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
            $table->decimal('monthly_price', 8, 2)->nullable();
            $table->text('monthly_includes')->nullable();
            $table->decimal('short_term_price', 8, 2)->nullable();
            $table->text('short_term_includes')->nullable();
            $table->integer('short_term_minimum_stay')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('apartments', function (Blueprint $table) {
            $table->dropColumn([
                'monthly_price',
                'monthly_includes',
                'short_term_price',
                'short_term_includes',
                'short_term_minimum_stay'
            ]);
        });
    }
};
