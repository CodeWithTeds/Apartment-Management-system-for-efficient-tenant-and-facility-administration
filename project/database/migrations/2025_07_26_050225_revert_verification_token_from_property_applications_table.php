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
        Schema::table('property_applications', function (Blueprint $table) {
            $table->dropColumn('verification_token');
            $table->enum('application_status', ['pending', 'approved', 'rejected'])->default('pending')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('property_applications', function (Blueprint $table) {
            $table->string('verification_token')->nullable()->after('document_path');
            $table->enum('application_status', ['unverified', 'pending', 'approved', 'rejected'])->default('unverified')->change();
        });
    }
};
