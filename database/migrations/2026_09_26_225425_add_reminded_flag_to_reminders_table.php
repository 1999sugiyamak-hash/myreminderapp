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
        Schema::table('reminders', function (Blueprint $table) {
            // Rename repeated column due to typo
            $table->renameColumn('repeted', 'repeated');
            // Add reminded flag column
            $table->boolean('reminded')->after('repeated')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reminders', function (Blueprint $table) {
            // Remove reminded flag column
            $table->dropColumn('reminded');
        });
    }
};
