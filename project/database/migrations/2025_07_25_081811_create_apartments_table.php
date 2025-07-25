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
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('name');
            $table->string('address');
            $table->integer('total_units')->nullable();
            $table->integer('available_units')->nullable();
            $table->string('capacity')->nullable();
            $table->string('rent_type')->nullable();
            $table->string('pet_policy')->nullable();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('status')->default('Active');
            $table->string('location')->nullable();
            $table->decimal('price', 10, 2)->default(0.00);
            $table->string('property_type')->nullable();
            $table->text('amenities')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apartments');
    }
};
