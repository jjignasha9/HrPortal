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
        Schema::table('hiring_leads', function (Blueprint $table) {
            $table->string('has_experience', 10)->nullable()->after('experience_years');
            $table->string('previous_company')->nullable()->after('has_experience');
        });
    }

    public function down(): void
    {
        Schema::table('hiring_leads', function (Blueprint $table) {
            $table->dropColumn(['has_experience', 'previous_company']);
        });
    }
};
