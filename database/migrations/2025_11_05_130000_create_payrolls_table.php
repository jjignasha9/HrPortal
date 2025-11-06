<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('payrolls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees')->cascadeOnDelete();
            $table->unsignedInteger('serial_no')->nullable();
            $table->string('unique_no', 50)->nullable();
            $table->string('salary_month', 50)->nullable();
            $table->string('format_type', 50)->default('Salary');
            $table->date('payment_date')->nullable();
            $table->decimal('payment_amount', 12, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payrolls');
    }
};


