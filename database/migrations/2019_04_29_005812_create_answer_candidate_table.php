<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswerCandidateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answer_candidate', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('candidate_id') ->unsigned();    
            $table->foreign('candidate_id')
            ->references('id')
            ->on('candidates')
            ->onDelete('cascade');
            $table->integer('answer_id')->unsigned();
            $table->foreign('answer_id')
            ->references('id')
            ->on('answers')
            ->onDelete('cascade');
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
        Schema::dropIfExists('answer_candidate');
    }
}
