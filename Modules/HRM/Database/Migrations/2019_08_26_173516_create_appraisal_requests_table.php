<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppraisalRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appraisal_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employee_officer_id');
            $table->string('job_name')->nullable();
            $table->string('reporting_date_start');
            $table->string('reporting_date_end');
            $table->unsignedInteger('requester_id');
            $table->unsignedInteger('receiver_id');
            $table->string('educational_qualifications');
            $table->string('total_job_period');
            $table->string('birth_date');
            $table->string('languages')->nullable();
            $table->text('special_training')->nullable();
            $table->text('reporting_job_period');
            $table->tinyInteger('is_submitted')->default(0);
            $table->tinyInteger('is_evaluated')->default(0);
            $table->tinyInteger('is_evaluation_submitted')->default(0);
            $table->tinyInteger('is_action_taken')->default(0);
            $table->text('comment')->nullable();
//            $table->enum('status', ['INITIATED', 'PENDING', 'EVALUATED', 'APPROVED', 'REJECTED'])->default('INITIATED');
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
        Schema::dropIfExists('appraisal_requests');
    }
}
