<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrintsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('print_records', function (Blueprint $table) {
            $table->id();
            $table->integer('number');
            $table->date('date');
            $table->string('tawkeel');
            $table->string('mekawel');
            $table->string('name');
            $table->string('s_w');
            $table->integer('count_40')->default(0);
            $table->integer('count_20')->default(0);
            $table->string('h_t')->default(0);
            $table->string('grant');
            $table->integer('sum');
            $table->integer('print_date_id');
            $table->timestamps();
        });
    }
}
