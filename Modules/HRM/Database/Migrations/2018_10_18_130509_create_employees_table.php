<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create( 'employees', function ( Blueprint $table ) {
			$table->increments( 'id');
			$table->string( 'employee_id');
			$table->string( 'first_name');
			$table->string( 'last_name');
            $table->string( 'photo' )->nullable();
            $table->string( 'signature' )->nullable();
			$table->string( 'email')->unique();
			$table->string( 'gender');
			$table->unsignedInteger( 'department_id');
            $table->unsignedInteger('section_id')->nullable();
			$table->unsignedInteger( 'designation_id');
            $table->boolean('is_divisional_director')->default(false);
			$table->string( 'status')->default( 'present');
			$table->string( 'tel_office')->nullable();
			$table->string( 'tel_home')->nullable();
			$table->string( 'mobile_one')->nullable();
			$table->string( 'mobile_two')->nullable();
			$table->timestamps();
			$table->softDeletes();
		} );
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists( 'employees' );
	}
}
