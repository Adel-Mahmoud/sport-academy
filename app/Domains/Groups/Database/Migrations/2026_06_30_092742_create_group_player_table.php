<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('group_player', function (Blueprint $table) {
            $table->id();
            $table->foreignId('group_id')->constrained()->onDelete('cascade');
            $table->foreignId('player_id')->constrained()->onDelete('cascade');
            $table->date('joined_at')->nullable();
            $table->string('status')->default('active');
            $table->timestamps();
            $table->unique(['group_id', 'player_id']); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('group_player');
    }
};
