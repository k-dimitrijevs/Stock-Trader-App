<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_stocks', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('stock_name');
            $table->string('stock_symbol');
            $table->string('stock_amount');
            $table->decimal('price');
            $table->decimal('total');
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
        Schema::dropIfExists('users_stocks');
    }
}
