<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('number');
            $table->date('date');
            $table->integer('tawkeel_id');
            $table->integer('mekawel_id');
            $table->string('name');
            $table->string('s_w');
            $table->integer('count_40')->default(0);
            $table->integer('count_20')->default(0);
            $table->string('h_t')->default(0);
            $table->string('grant');
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
        Schema::dropIfExists('orders');
    }
}
