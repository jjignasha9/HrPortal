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
        Schema::table('companies', function (Blueprint $table) {
            if (!Schema::hasColumn('companies', 'code')) $table->string('code')->unique()->after('id');
            if (!Schema::hasColumn('companies', 'name')) $table->string('name')->default('')->after('code');
            if (!Schema::hasColumn('companies', 'email')) $table->string('email')->nullable()->after('name');
            if (!Schema::hasColumn('companies', 'phone')) $table->string('phone', 20)->nullable()->after('email');
            if (!Schema::hasColumn('companies', 'website')) $table->string('website')->nullable()->after('phone');
            if (!Schema::hasColumn('companies', 'address')) $table->string('address')->nullable()->after('website');
            if (!Schema::hasColumn('companies', 'city')) $table->string('city')->nullable()->after('address');
            if (!Schema::hasColumn('companies', 'country')) $table->string('country')->nullable()->after('city');
            if (!Schema::hasColumn('companies', 'logo_path')) $table->string('logo_path')->nullable()->after('country');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            foreach (['logo_path','country','city','address','website','phone','email','name','code'] as $col) {
                if (Schema::hasColumn('companies', $col)) $table->dropColumn($col);
            }
        });
    }
};
