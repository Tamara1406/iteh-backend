<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('naziv');
            $table->string('sadrzaj');
            $table->integer('brojStrana');
            $table->foreignId('autor_id');
            $table->foreignId('sistemupravljanja_id');
            $table->foreignId('typedocument_id');
            $table->timestamps();
            $table->foreign("typedocument_id")->references('id')->on('type_documents');
            $table->foreign("autor_id")->references('id')->on('autor');
            $table->foreign("system_id")->references('id')->on('sistemupravljanja');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documents');
    }
}
