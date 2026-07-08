<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('level');
            $table->foreignId('sport_id')->constrained()->onDelete('cascade');
            $table->string('description')->nullable();
            $table->integer('capacity')->default(0);
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();   
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('groups');
    }
};
