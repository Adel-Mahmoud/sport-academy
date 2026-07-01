<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('group_coach', function (Blueprint $table) {
            $table->id();
            $table->foreignId('group_id')->constrained()->onDelete('cascade');
            $table->foreignId('coach_id')->constrained()->onDelete('cascade');
            $table->string('role')->default('head');
            $table->boolean('is_primary')->default(true);
            $table->string('status')->nullable('active');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('group_coach');
    }
};
