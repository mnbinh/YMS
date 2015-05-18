<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SetUpExecutiveCommitteeUnion extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
        Schema::create('competences' , function($table){
            $table->increments('id');
            $table->string('code');
            $table->string('name');
        });
        Schema::create('prorogues' , function($table){
            $table->increments('id');
            $table->string('name');
            $table->date('start');
            $table->date('end');
        });
        Schema::create('competence_details', function ($table) {
            $table->increments('id');
            $table->integer('member_id')->unsigned();
            $table->foreign('member_id')->references('id')->on('youth_members')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->integer('competence_id')->unsigned();
            $table->foreign('competence_id')->references('id')->on('competences')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->integer('prorogue_id')->unsigned();
            $table->foreign('prorogue_id')->references('id')->on('prorogues')
                ->onUpdate('cascade')->onDelete('cascade');
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
		//
        Schema::drop('competences_details');
        Schema::drop('prorogues');
        Schema::drop('competences');
	}

}
