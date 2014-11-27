<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateUsersTable extends Migration {

    public function up()
	{
		Schema::create('users', function($table) {
		    $table->increments('id');
		    $table->string('email')->unique();
		    $table->string('remember_token',100); 
		    $table->string('password');
		    $table->string('Firstname');
		    $table->string('Lastname');
		    $table->boolean('Teacher'); #Teacher or Student?
		    $table->timestamps();
		});
	}

    public function down()
	{
		Schema::drop('users');
	}
}