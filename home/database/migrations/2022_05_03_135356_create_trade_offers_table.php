<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTradeOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trade_offers', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('stock_id')->unsigned()->index()->nullable();
            $table->foreign('stock_id')
                ->references('id')
                ->on('stocks')
                ->onDelete('cascade');

            $table->bigInteger('type_id')->unsigned()->index()->nullable();
            $table->foreign('type_id')
                ->references('id')
                ->on('type_offers')
                ->onDelete('cascade');

            $table->string('name');
            $table->string('supplier_article');
            $table->string('article');
            $table->float('price')->nullable();
            $table->float('retail')->nullable();
            $table->integer('count')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trade_offers');
    }
}
