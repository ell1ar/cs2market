<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('player_vk_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('player_id')->constrained()->onDelete('cascade');
            $table->string('vk_id')->unique();
            $table->string('nickname')->nullable();
            $table->string('avatar_url')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('player_vk_accounts');
    }
};