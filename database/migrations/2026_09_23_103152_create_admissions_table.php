<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('admissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('patients')->onDelete('cascade');
            $table->foreignId('doctor_id')->nullable()->constrained('doctors')->onDelete('set null');
            $table->string('ward')->nullable();        // e.g. General, ICU, Maternity
            $table->string('bed_number')->nullable();
            $table->dateTime('admission_date');
            $table->dateTime('discharge_date')->nullable();
            $table->text('reason')->nullable();          // reason for admission
            $table->text('diagnosis')->nullable();
            $table->decimal('total_charges', 10, 2)->default(0);
            $table->enum('status', ['admitted', 'discharged', 'transferred'])->default('admitted');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admissions');
    }
};
