<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SetUpTablesActivity extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

		//
        Schema::create('union_activities', function ($table) {
            $table->increments('id');
            $table->text('description');
            $table->date('time');
            $table->boolean('confirm')->default(false);
            $table->string('place');
            $table->integer('semester_id')->unsigned();
            $table->foreign('semester_id')->references('id')->on('semesters')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->integer('youth_union_id')->unsigned();
            $table->foreign('youth_union_id')->references('id')->on('youth_unions')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();


        });
        Schema::create('participators' , function($table){
            $table->increments('id');
            $table->boolean('present')->default(true);
            $table->integer('youth_member_id')->unsigned();
            $table->foreign('youth_member_id')->references('id')->on('youth_members')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->integer('union_activity_id')->unsigned();
            $table->foreign('union_activity_id')->references('id')->on('union_activities')
                ->onUpdate('cascade')->onDelete('cascade');

        });
        Schema::create('school_activities', function ($table) {
            $table->increments('id');
            $table->text('description');
            $table->string('name');
            $table->date('date');
            $table->date('expired_date');
            $table->string('place');
            $table->boolean('is_union');
            $table->integer('semester_id')->unsigned();
            $table->foreign('semester_id')->references('id')->on('semesters')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();

        });
        Schema::create('joins', function ($table) {
            $table->increments('id');
            $table->integer('school_activity_id');
            $table->integer('join_id')->unsigned()->index();
            $table->string('join_type');
            $table->boolean('present')->default(true);

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
        Schema::drop('joins');
        Schema::drop('participators');
        Schema::drop('union_activities');
        Schema::drop('school_activities');

	}

}
