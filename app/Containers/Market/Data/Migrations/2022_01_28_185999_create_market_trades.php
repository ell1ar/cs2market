<?php

use App\Containers\Market\Data\Enums\MarketTradeStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up()
    {
        Schema::create('market_trades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('player_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('market_item_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->decimal('price', 64, 2, true)->nullable();
            $table->enum('status', array_column(MarketTradeStatus::cases(), 'value'));
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    public function down()
    {
        Schema::dropIfExists('market_trades');
    }
};
