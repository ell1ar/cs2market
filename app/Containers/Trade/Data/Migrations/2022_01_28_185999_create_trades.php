<?php

use App\Containers\Trade\Data\Enums\Status as TradeStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up()
    {
        Schema::create('trades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('player_item_id')->constrained('player_items')->onUpdate('cascade')->onDelete('cascade');
            $table->string('custom_id', 255);
            $table->decimal('paid', 64, 2, true)->nullable();
            $table->enum('status', array_column(TradeStatus::cases(), 'value'));
            $table->text('result');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    public function down()
    {
        Schema::dropIfExists('trades');
    }
};
