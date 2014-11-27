<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimesTable extends Migration {
	public function up()
	{
		Schema::create('times', function($table) {
        $table->increments('id');
        $table->integer('user_id')->unsigned();
		$table->integer('teacher_id')->unsigned();

        # Define FK foreign keys:
        $table->foreign('user_id')->references('id')->on('users'); #User ID
        $table->foreign('teacher_id')->references('id')->on('users'); #Student's teacher's id

        $table->time('MondayStart');
        $table->time('MondayEnd');
        $table->time('TuesdayStart');
        $table->time('TuesdayEnd');
        $table->time('WednesdayStart');
        $table->time('WednesdayEnd');
        $table->time('ThursdayStart');
        $table->time('ThursdayEnd');
        $table->time('FridayStart');
        $table->time('FridayEnd');
        $table->text('comment');
		});
	}

	/**
	 * Reverse the migrations.
	 * @return void
	 */
	public function down()
	{
		Schema::drop('times');
	}

}
