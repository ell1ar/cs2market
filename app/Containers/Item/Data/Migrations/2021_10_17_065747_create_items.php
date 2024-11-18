<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('market_hash_name');
            $table->string('ru_market_hash_name')->nullable();
            $table->decimal('price', 64, 2, true);
            $table->decimal('price_market', 64, 2, true);
            $table->integer('quantity');
            $table->string('quality', 255)->nullable();
            $table->string('rarity', 255)->nullable();
            $table->string('class_instance', 255)->nullable();
            $table->boolean('is_updatable')->default(true);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    public function down()
    {
        Schema::dropIfExists('items');
    }
};
