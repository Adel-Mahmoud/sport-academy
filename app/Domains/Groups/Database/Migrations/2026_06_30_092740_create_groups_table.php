<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('academy_groups', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('level');
            $table->foreignId('sport_id')->constrained()->onDelete('cascade');
            // $table->foreignId('branch_id')->nullable()->constrained()->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('groups');
    }
};
