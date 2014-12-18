<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGradesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('grades', function($table) {
		    $table->increments('id');
            $table->integer('student_id')->unsigned();
            # Define FK foreign keys:
            $table->foreign('student_id')->references('id')->on('users');

            $table->date('date');
            $table->text('grade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('grades');
	}

}
