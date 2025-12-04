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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained()->onDelete('cascade');
            $table->foreignId('doctor_id')->nullable()->constrained('doctors')->nullOnDelete();
            $table->dateTime('appointment_date');
            $table->enum('type', ['online', 'walk-in'])->default('online');
            $table->enum('status', [
                'Pending',
                'Scheduled',
                'Checked-In',
                'In-Progress',
                'Completed',
                'Cancelled',
                'No-Show' ])->default('Pending');

            $table->string('reason')->nullable();
            $table->text('notes')->nullable();

            $table->dateTime('check_in_time')->nullable();
            $table->dateTime('completed_at')->nullable();
            $table->dateTime('cancelled_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
