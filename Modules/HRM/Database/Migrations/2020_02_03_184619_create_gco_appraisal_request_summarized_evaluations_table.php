<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGcoAppraisalRequestSummarizedEvaluationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gco_appraisal_request_summarized_evaluations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('appraisal_request_id');
            $table->unsignedInteger('actor_id');
            $table->unsignedInteger('receiver_id');
            $table->text('comment');
            $table->enum('special_qualifications_options', ['administrative', 'official', 'exterior', 'other'])->nullable();
            $table->text('moral')->nullable();
            $table->text('intellectual')->nullable();
            $table->text('medical')->nullable();
            $table->text('further_recommendation')->nullable();
            $table->tinyInteger('final_decision');
            $table->text('other_recommendation')->nullable();
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
        Schema::dropIfExists('gco_appraisal_request_summarized_evaluations');
    }
}