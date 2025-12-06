<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cashiers', function (Blueprint $table) {
            $table->id();
            $table->string('employee_id')->unique()->nullable();
            $table->string('cashier_code')->unique()->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->string('profile_image')->nullable();
            $table->date('date_hired')->nullable();
            $table->enum('shift', ['morning', 'afternoon', 'night'])->nullable();
            $table->enum('status', ['active', 'inactive', 'on_leave','terminated'])->default('active');
            $table->decimal('float_amount', 10, 2)->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes(); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cashiers');
    }
};
