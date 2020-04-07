<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGcoAppraisalRequestActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gco_appraisal_request_actions', function (Blueprint $table) {
            $table->increments('id');
            $table->string( 'photo' )->nullable();
            $table->unsignedInteger('appraisal_request_id');
            $table->unsignedInteger('actor_id');
            $table->enum('rating', ['excellent', 'best', 'good', 'bad', 'worst'])->nullable();
            $table->text('comment');
            $table->unsignedInteger('total_marks');
            $table->enum('action', ['Approve', 'Reject', 'Save']);
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
        Schema::dropIfExists('gco_appraisal_request_actions');
    }
}
