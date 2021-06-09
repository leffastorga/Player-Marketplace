<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionBuysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_buys', function (Blueprint $table) {
            $table->id();
            $table->integer('card_id');
            $table->integer('user_id_seller');
            $table->integer('user_id_buyer');
            $table->double('price',6,2);
            $table->dateTime('date_transaction');
            $table->boolean('scheduled');
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
        Schema::dropIfExists('transaction_buys');
    }
}
