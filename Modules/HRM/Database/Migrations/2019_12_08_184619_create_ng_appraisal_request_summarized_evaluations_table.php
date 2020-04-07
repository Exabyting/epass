<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNgAppraisalRequestSummarizedEvaluationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ng_appraisal_request_summarized_evaluations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('appraisal_request_id');
            $table->unsignedInteger('actor_id');
            $table->unsignedInteger('receiver_id');
            $table->enum('summarized_rating', ['excellent', 'best', 'good', 'bad', 'worst'])->nullable();
            $table->tinyInteger('final_decision');
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
        Schema::dropIfExists('ng_appraisal_request_summarized_evaluations');
    }
}
