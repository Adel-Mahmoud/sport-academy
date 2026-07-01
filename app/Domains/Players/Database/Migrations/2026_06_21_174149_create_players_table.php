<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('phone')->nullable();
            $table->string('school')->nullable();
            $table->float('weight')->nullable();
            $table->float('height')->nullable();
            $table->string('blood_type', 3)->nullable();
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->unsignedInteger('age')->nullable();
            $table->string('address')->nullable();
            $table->string('location')->nullable();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('national_id')->nullable()->unique();
            $table->string('status')->nullable('active');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('players');
    }
};
