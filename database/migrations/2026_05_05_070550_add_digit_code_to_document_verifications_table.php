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
        Schema::table('document_verifications', function (Blueprint $table) {
            $table->string('digit_code', 4)->nullable()->after('verification_code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('document_verifications', function (Blueprint $table) {
            $table->dropColumn('digit_code');
        });
    }
};
