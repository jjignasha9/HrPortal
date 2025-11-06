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
        Schema::table('inquiries', function (Blueprint $table) {
            $table->string('code')->unique()->after('id');
            $table->string('name')->nullable()->after('code');
            $table->string('email')->nullable()->after('name');
            $table->string('phone', 20)->nullable()->after('email');
            $table->string('source')->nullable()->after('phone');
            $table->text('message')->nullable()->after('source');
            $table->string('status')->default('open')->after('message');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inquiries', function (Blueprint $table) {
            $table->dropColumn(['code','name','email','phone','source','message','status']);
        });
    }
};
