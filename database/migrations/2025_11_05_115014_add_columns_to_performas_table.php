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
        Schema::table('performas', function (Blueprint $table) {
            if (!Schema::hasColumn('performas','number')) $table->string('number')->unique()->after('id');
            if (!Schema::hasColumn('performas','date')) $table->date('date')->after('number');
            if (!Schema::hasColumn('performas','client_name')) $table->string('client_name')->after('date');
            if (!Schema::hasColumn('performas','client_email')) $table->string('client_email')->nullable()->after('client_name');
            if (!Schema::hasColumn('performas','client_phone')) $table->string('client_phone')->nullable()->after('client_email');
            if (!Schema::hasColumn('performas','client_address')) $table->text('client_address')->nullable()->after('client_phone');
            if (!Schema::hasColumn('performas','subtotal')) $table->decimal('subtotal',12,2)->default(0)->after('client_address');
            if (!Schema::hasColumn('performas','tax')) $table->decimal('tax',12,2)->default(0)->after('subtotal');
            if (!Schema::hasColumn('performas','total')) $table->decimal('total',12,2)->default(0)->after('tax');
            if (!Schema::hasColumn('performas','items')) $table->json('items')->after('total');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('performas', function (Blueprint $table) {
            foreach (['items','total','tax','subtotal','client_address','client_phone','client_email','client_name','date','number'] as $col) {
                if (Schema::hasColumn('performas',$col)) $table->dropColumn($col);
            }
        });
    }
};
