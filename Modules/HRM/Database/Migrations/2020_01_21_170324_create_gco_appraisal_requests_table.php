<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGcoAppraisalRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gco_appraisal_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employee_officer_id');
            $table->string( 'medical_report_photo' );
            $table->string('reporting_date_start');
            $table->string('reporting_date_end');
            $table->unsignedInteger('requester_id');
            $table->unsignedInteger('receiver_id');
            $table->tinyInteger('is_submitted')->default(0);
            $table->tinyInteger('is_submitted_personal_Info')->default(0);
            $table->tinyInteger('is_save_personal_Info')->default(0);
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
        Schema::dropIfExists('gco_appraisal_requests');
    }
}
