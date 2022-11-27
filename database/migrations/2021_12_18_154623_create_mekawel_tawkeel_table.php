<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMekawelTawkeelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mekawel_tawkeel', function (Blueprint $table) {
            $table->id();
            $table->integer("tawkeel_id");
            $table->integer("mekawel_id");
            $table->integer("mekawel_price_20");
            $table->integer("mekawel_price_40");
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
        Schema::dropIfExists('mekawel_tawkeel');
    }
}
