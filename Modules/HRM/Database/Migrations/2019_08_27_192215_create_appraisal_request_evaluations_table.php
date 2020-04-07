<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppraisalRequestEvaluationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appraisal_request_evaluations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('appraisal_request_id');
            $table->unsignedInteger('actor_id');
            $table->unsignedInteger('evaluation_question_id')->nullable();
            $table->enum('rating', ['excellent', 'best', 'good', 'bad', 'worst'])->nullable();
            $table->text('comment')->nullable();
            $table->string('custom_question')->nullable();
            $table->tinyInteger('applicable_rating')->nullable();
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
        Schema::dropIfExists('appraisal_request_evaluations');
    }
}
