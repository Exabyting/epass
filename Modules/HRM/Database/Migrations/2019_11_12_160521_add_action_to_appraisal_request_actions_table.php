<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddActionToAppraisalRequestActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('appraisal_request_actions', function (Blueprint $table) {
            DB::statement("ALTER TABLE appraisal_request_actions CHANGE COLUMN `action` `action` ENUM('Approve', 'Reject', 'Save') NOT NULL DEFAULT 'Save'");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('appraisal_request_actions', function (Blueprint $table) {
            DB::statement("ALTER TABLE appraisal_request_actions CHANGE COLUMN `action` `action` ENUM('Approve', 'Reject')");
        });
    }
}
