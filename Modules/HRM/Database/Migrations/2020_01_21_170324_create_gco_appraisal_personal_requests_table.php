<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGcoAppraisalPersonalRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gco_appraisal_personal_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employee_officer_id');
            $table->integer('gco_appraisal_request_id');
            $table->string( 'name');
            $table->string( 'designation');
            $table->string( 'birth_date');
            $table->string( 'father_name');
            $table->string( 'marital_status');
            $table->string( 'number_of_children')->nullable();
            $table->string( 'service_cadre_name')->nullable();
            $table->string( 'govt_service_start_date');
            $table->string( 'gazetted_service_start_date');
            $table->string( 'cadre_service_start_date');
            $table->string('current_post_joining_date');
            $table->string('salary_scale');
            $table->string('office_name');
            $table->string('current_salary_scale');
            $table->string('educational_qualifications');
            $table->text('training_country')->nullable();
            $table->text('training_forign')->nullable();
            $table->text('forign_skill_reading')->nullable();
            $table->text('forign_skill_speaking')->nullable();
            $table->text('forign_skill_writing')->nullable();
            $table->text('comment_one');
            $table->text('comment_two')->nullable();
            $table->text('comment_three')->nullable();
            $table->text('comment_four')->nullable();
            $table->text('comment_five')->nullable();
            $table->string('reporting_date_start');
            $table->string('reporting_date_end');
            $table->unsignedInteger('requester_id');
            $table->unsignedInteger('receiver_id');
            $table->tinyInteger('is_submitted')->default(0);
            $table->tinyInteger('is_evaluated')->default(0);
            $table->tinyInteger('is_evaluation_submitted')->default(0);
            $table->tinyInteger('is_action_taken')->default(0);
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
        Schema::dropIfExists('gco_appraisal_personal_requests');
    }
}
