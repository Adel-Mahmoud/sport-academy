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
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->string("player_name");
            $table->string("date_of_pirth");
            $table->string("phone");
            $table->string("email");
            $table->string("profile_picture");
            $table->string("id_card_picture");
            $table->string("club_membership_picture");
            $table->unsignedBigInteger('sport_id'); 
            $table->foreign('sport_id')->references('id')->on('teams'); 
            $table->unsignedBigInteger('team_id'); 
            $table->foreign('team_id')->references('id')->on('teams'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('players');
    }
};
