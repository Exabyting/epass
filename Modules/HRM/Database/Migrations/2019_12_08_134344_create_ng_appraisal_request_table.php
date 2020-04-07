<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNgAppraisalRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ng_appraisal_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employee_officer_id');
            $table->string('job_name')->nullable();
            $table->string('reporting_date_start');
            $table->string('reporting_date_end');
            $table->unsignedInteger('requester_id');
            $table->unsignedInteger('receiver_id');
            $table->string('educational_qualifications');
            $table->string('current_post_joining_date');
            $table->string('joining_date_govt_job');
            $table->string('salary_scale');
            $table->boolean('is_divisional_exam_passed')->default(0);
            $table->string('divisional_exam_passed_date')->nullable();
            $table->enum('job_state', ['entrant', 'permanent', 'temporary']);
            $table->string('birth_date');
            $table->string('languages')->nullable();
            $table->text('special_training')->nullable();
            $table->text('reporting_job_period');
            $table->tinyInteger('is_submitted')->default(0);
            $table->tinyInteger('is_evaluated')->default(0);
            $table->tinyInteger('is_evaluation_submitted')->default(0);
            $table->tinyInteger('is_action_taken')->default(0);
            $table->text('comment')->nullable();
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
        Schema::dropIfExists('ng_appraisal_requests');
    }
}
