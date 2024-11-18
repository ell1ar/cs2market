<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('trade_link', 255)->nullable()->unique();
            $table->decimal('balance', 64, 2, true)->default(0.00);
            $table->string('image', 255)->nullable();
            $table->boolean('is_ban')->default(false);
            $table->boolean('is_trade')->default(true);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('players');
    }
};
