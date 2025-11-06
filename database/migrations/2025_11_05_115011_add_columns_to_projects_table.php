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
        Schema::table('projects', function (Blueprint $table) {
            if (!Schema::hasColumn('projects','code')) $table->string('code')->unique()->after('id');
            if (!Schema::hasColumn('projects','name')) $table->string('name')->default('')->after('code');
            if (!Schema::hasColumn('projects','company_id')) $table->foreignId('company_id')->nullable()->constrained('companies')->nullOnDelete()->after('name');
            if (!Schema::hasColumn('projects','start_date')) $table->date('start_date')->nullable()->after('company_id');
            if (!Schema::hasColumn('projects','end_date')) $table->date('end_date')->nullable()->after('start_date');
            if (!Schema::hasColumn('projects','status')) $table->string('status')->default('planned')->after('end_date');
            if (!Schema::hasColumn('projects','budget')) $table->decimal('budget',12,2)->nullable()->after('status');
            if (!Schema::hasColumn('projects','description')) $table->text('description')->nullable()->after('budget');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            foreach (['description','budget','status','end_date','start_date','company_id','name','code'] as $col) {
                if (Schema::hasColumn('projects',$col)) $table->dropColumn($col);
            }
        });
    }
};
