<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SetUpTablesListFelicitationYouth extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
        Schema::create('semesters', function ($table) {
            $table->increments('id');
            $table->string('year');
            $table->string('semester');
        });
        Schema::create('felicitations', function ($table) {
            $table->increments('id');
            $table->string('name');
        });
        Schema::create('periods' , function($table){
            $table->increments('id');
            $table->string('name');
            $table->boolean('expired');
            $table->date('begin_date');
            $table->date('end_date');
            $table->date('expired_date');
            $table->string('description');
            $table->integer('semester_id')->unsigned()->index();;
            $table->foreign('semester_id')->references('id')->on('semesters')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();

        });
        Schema::create('list_felicitations' , function($table){
            $table->increments('id');
            $table->string('name');
            $table->integer('period_id')->unsigned();
            $table->boolean('is_sent')->default(false);
            $table->boolean('is_confirm')->default(false);
            $table->foreign('period_id')->references('id')->on('periods')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->integer('member_id')->unsigned()->index();
            $table->foreign('member_id')->references('id')->on('youth_members')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('detail_felicitations' , function($table){
            $table->increments('id');
            $table->date('date');
            $table->string('decision_no');
            $table->string('detail');
            $table->string('suggested');
            $table->boolean('confirm')->default(false);
            $table->integer('list_id')->unsigned()->index();
            $table->foreign('list_id')->references('id')->on('list_felicitations')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->integer('member_id')->unsigned()->index();
            $table->foreign('member_id')->references('id')->on('youth_members')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->integer('bonus_id')->unsigned()->index();
            $table->foreign('bonus_id')->references('id')->on('felicitations')
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

        Schema::drop('detail_felicitations');
        Schema::drop('list_felicitations');
        Schema::drop('periods');
        Schema::drop('semesters');
        Schema::drop('felicitations');
	}

}
