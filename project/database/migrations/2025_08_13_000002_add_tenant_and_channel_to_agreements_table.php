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
        Schema::table('agreements', function (Blueprint $table) {
            $table->foreignId('tenant_id')->nullable()->after('admin_id')->constrained('users')->onDelete('cascade');
            $table->enum('channel', ['superadmin_to_admin', 'admin_to_tenant'])->nullable()->after('tenant_id');
            $table->index('channel');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('agreements', function (Blueprint $table) {
            $table->dropIndex(['channel']);
            $table->dropColumn('channel');
            $table->dropConstrainedForeignId('tenant_id');
        });
    }
};


