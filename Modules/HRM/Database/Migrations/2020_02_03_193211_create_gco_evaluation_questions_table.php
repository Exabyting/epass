<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGcoEvaluationQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gco_evaluation_questions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('position');
            $table->string('question')->nullable();
            $table->enum('type', ['primary', 'special', 'optional'])->default('primary');
            $table->string('optional_answer_1')->nullable();
            $table->string('optional_answer_2')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gco_evaluation_questions');
    }
}
