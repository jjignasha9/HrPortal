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
        Schema::table('tickets', function (Blueprint $table) {
            if (!Schema::hasColumn('tickets','code')) $table->string('code')->unique()->after('id');
            if (!Schema::hasColumn('tickets','title')) $table->string('title')->after('code');
            if (!Schema::hasColumn('tickets','description')) $table->text('description')->nullable()->after('title');
            if (!Schema::hasColumn('tickets','priority')) $table->string('priority')->default('medium')->after('description');
            if (!Schema::hasColumn('tickets','status')) $table->string('status')->default('open')->after('priority');
            if (!Schema::hasColumn('tickets','created_by')) $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete()->after('status');
            if (!Schema::hasColumn('tickets','assigned_to')) $table->foreignId('assigned_to')->nullable()->constrained('users')->nullOnDelete()->after('created_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            foreach (['assigned_to','created_by','status','priority','description','title','code'] as $col) {
                if (Schema::hasColumn('tickets',$col)) $table->dropColumn($col);
            }
        });
    }
};
