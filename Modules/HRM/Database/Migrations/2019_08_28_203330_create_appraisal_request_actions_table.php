<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppraisalRequestActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appraisal_request_actions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('appraisal_request_id');
            $table->unsignedInteger('actor_id');
            $table->enum('rating', ['excellent', 'best', 'good', 'bad', 'worst'])->nullable();
            $table->text('comment');
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
        Schema::dropIfExists('appraisal_request_actions');
    }
}
