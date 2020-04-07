<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppraisalRequestHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appraisal_request_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('transition');
            $table->string('from')->nullable();
            $table->string('to')->nullable();
            $table->integer('actor_id')->nullable();
            $table->integer('recipient_id')->nullable();
            $table->integer('request_id');
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
        Schema::dropIfExists('appraisal_request_histories');
    }
}
