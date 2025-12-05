<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('gender')->nullable();
            $table->date('birthdate')->nullable();
            $table->string('license_no')->unique();
            $table->string('ptr_no')->nullable();
            $table->string('s2_no')->nullable();
            $table->string('specialization');
            $table->string('sub_specialization')->nullable();
            $table->string('department')->nullable();
            $table->integer('years_experience')->default(0);
            $table->decimal('consultation_fee', 10, 2)->default(0);
            $table->string('status')->default('active');
            $table->string('profile_image')->nullable();
            $table->text('address')->nullable();
            $table->text('bio')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
