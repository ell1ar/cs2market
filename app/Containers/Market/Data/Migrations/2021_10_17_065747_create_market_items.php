<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('market_items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('icon')->nullable();
            $table->decimal('price', 64, 2, true);
            $table->string('quality', 255)->nullable();
            $table->string('rarity', 255)->nullable();
            $table->decimal('float', 64, 2, true)->nullable();
            $table->json('stickers')->nullable();
            $table->string('class_instance', 255)->unique()->nullable();
            $table->string('market');
            $table->json('market_info')->nullable();
            $table->json('steam_info')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    public function down()
    {
        Schema::dropIfExists('market_items');
    }
};
