<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('subscription_plans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sport_id')->constrained()->cascadeOnDelete();
            $table->foreignId('sport_level_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('membership_tier_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('subscription_type_id')->constrained()->cascadeOnDelete();
            $table->foreignId('group_id')->nullable()->constrained()->nullOnDelete();
            $table->decimal('price', 10, 2);
            $table->unsignedInteger('sessions')->nullable();
            $table->unsignedInteger('duration')->nullable();
            $table->string('duration_unit')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subscription_plans');
    }
};
