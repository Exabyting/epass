<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppraisalReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appraisal_reports', function (Blueprint $table) {
            $table->increments('id');
            $table->string('job_name');
            $table->dateTime('reporting_date_start');
            $table->dateTime('reporting_date_end');
            $table->unsignedInteger('requester_id');
            $table->unsignedInteger('receiver_id');
            $table->string('educational_qualifications');
            $table->string('total_job_period');
            $table->string('birth_date');
            $table->string('languages')->nullable();
            $table->text('special_training')->nullable();
            $table->text('reporting_job_period');
            $table->string('job_history_designation');
            $table->string('job_history_duration');
            $table->string('job_history_salary_scale');
            $table->text('job_history_comment')->nullable();
            $table->tinyInteger('is_submitted')->default(0);
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
        Schema::dropIfExists('appraisal_reports');
    }
}
