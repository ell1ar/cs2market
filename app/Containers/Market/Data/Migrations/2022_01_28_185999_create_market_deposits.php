<?php

use App\Containers\Market\Data\Enums\MarketDepositStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up()
    {
        Schema::create('market_deposits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('player_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('uuid')->unique();
            $table->json('data');
            $table->string('external_id')->nullable();
            $table->string('market');
            $table->enum('status', array_column(MarketDepositStatus::cases(), 'value'));
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    public function down()
    {
        Schema::dropIfExists('market_deposits');
    }
};
