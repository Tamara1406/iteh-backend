<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSistemupravljanjasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sistem_upravljanjas', function (Blueprint $table) {
            $table->id();
            $table->string('operativniSistem');
            $table->integer('maxDokumenata');
            $table->double('brzinaUcitavanja');
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
        Schema::dropIfExists('sistemupravljanja');
    }
}
