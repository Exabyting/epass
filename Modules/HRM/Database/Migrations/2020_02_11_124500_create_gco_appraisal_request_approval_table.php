<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGcoAppraisalRequestApprovalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gco_appraisal_request_approvals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('appraisal_request_id');
            $table->string('filled_up_date')->nullable();
            $table->string('cause_of_late')->nullable();
            $table->string('work_on_application')->nullable();
            $table->enum('status',['On processing', 'Completed'])->default('On processing');
            $table->integer('actor_id')->nullable();
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
        Schema::dropIfExists('gco_appraisal_request_approvals');
    }
}
