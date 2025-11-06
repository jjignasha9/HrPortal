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
        Schema::create('hiring_leads', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->string('mobile', 20)->nullable();
            $table->string('address')->nullable();
            $table->string('position')->nullable();
            $table->decimal('experience_years', 4, 1)->default(0);
            $table->decimal('expected_salary', 12, 2)->nullable();
            $table->enum('gender', ['male','female','other'])->nullable();
            $table->string('resume_path')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hiring_leads');
    }
};
