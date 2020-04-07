<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNgAppraisalRequestJobHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ng_appraisal_request_job_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('appraisal_request_id');
            $table->string('designation');
            $table->string('duration');
            $table->string('salary_scale');
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
        Schema::dropIfExists('ng_appraisal_request_job_histories');
    }
}
