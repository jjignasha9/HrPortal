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
        Schema::table('vouchers', function (Blueprint $table) {
            if (!Schema::hasColumn('vouchers','number')) $table->string('number')->unique()->after('id');
            if (!Schema::hasColumn('vouchers','date')) $table->date('date')->after('number');
            if (!Schema::hasColumn('vouchers','payee_name')) $table->string('payee_name')->after('date');
            if (!Schema::hasColumn('vouchers','amount')) $table->decimal('amount',12,2)->after('payee_name');
            if (!Schema::hasColumn('vouchers','mode')) $table->string('mode')->nullable()->after('amount');
            if (!Schema::hasColumn('vouchers','reference')) $table->string('reference')->nullable()->after('mode');
            if (!Schema::hasColumn('vouchers','notes')) $table->text('notes')->nullable()->after('reference');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vouchers', function (Blueprint $table) {
            foreach (['notes','reference','mode','amount','payee_name','date','number'] as $col) {
                if (Schema::hasColumn('vouchers',$col)) $table->dropColumn($col);
            }
        });
    }
};
