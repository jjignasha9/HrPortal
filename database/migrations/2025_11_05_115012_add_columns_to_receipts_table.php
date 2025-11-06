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
        Schema::table('receipts', function (Blueprint $table) {
            if (!Schema::hasColumn('receipts','number')) $table->string('number')->unique()->after('id');
            if (!Schema::hasColumn('receipts','date')) $table->date('date')->after('number');
            if (!Schema::hasColumn('receipts','payer_name')) $table->string('payer_name')->after('date');
            if (!Schema::hasColumn('receipts','payer_email')) $table->string('payer_email')->nullable()->after('payer_name');
            if (!Schema::hasColumn('receipts','amount')) $table->decimal('amount',12,2)->after('payer_email');
            if (!Schema::hasColumn('receipts','mode')) $table->string('mode')->nullable()->after('amount');
            if (!Schema::hasColumn('receipts','reference')) $table->string('reference')->nullable()->after('mode');
            if (!Schema::hasColumn('receipts','notes')) $table->text('notes')->nullable()->after('reference');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('receipts', function (Blueprint $table) {
            foreach (['notes','reference','mode','amount','payer_email','payer_name','date','number'] as $col) {
                if (Schema::hasColumn('receipts',$col)) $table->dropColumn($col);
            }
        });
    }
};
