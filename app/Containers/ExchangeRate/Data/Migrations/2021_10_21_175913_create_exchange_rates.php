<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('exchange_rates', function (Blueprint $table) {
            $table->id();
            $table->integer('num_code')->unique()->nullable();
            $table->string('char_code', 4)->unique();
            $table->integer('nominal');
            $table->string('name', 255)->unique();
            $table->float('in_rub');
            $table->float('in_rub_previous');
            $table->boolean('is_updatable')->default(true);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    public function down()
    {
        Schema::dropIfExists('exchange_rates');
    }
};
