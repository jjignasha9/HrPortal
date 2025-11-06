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
        Schema::table('quotations', function (Blueprint $table) {
            $table->string('code')->unique()->after('id');
            $table->enum('type', ['standard','premium'])->default('standard')->after('code');
            $table->string('client_name')->nullable()->after('type');
            $table->string('client_email')->nullable()->after('client_name');
            $table->decimal('amount', 12, 2)->default(0)->after('client_email');
            $table->string('status')->default('draft')->after('amount');
            $table->text('notes')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('quotations', function (Blueprint $table) {
            $table->dropColumn(['code','type','client_name','client_email','amount','status','notes']);
        });
    }
};
