<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('player_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('player_id')->constrained('players')->onUpdate('cascade')->onDelete('cascade');
            $table->string('market_hash_name', 255);
            $table->decimal('price', 64, 2, true)->unsigned();
            $table->string('uniqid', 36);
            $table->morphs('dropable');
            $table->integer('status')->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    public function down()
    {
        Schema::dropIfExists('player_items');
    }
};
