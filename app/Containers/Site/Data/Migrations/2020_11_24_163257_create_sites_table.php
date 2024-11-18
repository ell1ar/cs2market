<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class  extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('site_categories')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('position')->unsigned();
            $table->text('instruction')->nullable();
            $table->string('price', 255);
            $table->string('image', 255);
            $table->string('promo', 255)->nullable();
            $table->string('link', 255);
            $table->tinyInteger('is_new')->default(1);
            $table->tinyInteger('is_hot')->default(0);
            $table->tinyInteger('is_vpn')->default(0);
            $table->tinyInteger('is_vip')->default(0);
            $table->tinyInteger('is_active')->default(1);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sites');
    }
};
