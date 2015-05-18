<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeacherTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
        Schema::create('teachers' , function($table){
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->integer('teacher_id')->unsigned();
            $table->boolean('is_sent')->default(false);
            $table->string('email');
            $table->date('bird_date');
            $table->timestamps();
        });
        Schema::create('teach_details' , function($table){
            $table->increments('id');

            $table->integer('teach_id')->unsigned()->index();
            $table->foreign('teach_id')->references('id')->on('teachers')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->integer('union_id')->unsigned()->index();
            $table->foreign('union_id')->references('id')->on('youth_unions')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->integer('semester_id')->unsigned()->index();
            $table->foreign('semester_id')->references('id')->on('semesters')
                ->onUpdate('cascade')->onDelete('cascade');


        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
        Schema::drop('teach_details');
        Schema::drop('teachers');

	}

}
