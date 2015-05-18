<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SetUpExecutiveSchool extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
    public function up()
    {
        //

        Schema::create('school_prorogues' , function($table){
            $table->increments('id');
            $table->string('name');
            $table->date('start');
            $table->date('end');
        });
        Schema::create('type_competences' , function($table){
            $table->increments('id');
            $table->string('name');

        });


        Schema::create('executive_details', function ($table) {
            $table->increments('id');
            $table->integer('member_id')->unsigned();
            $table->foreign('member_id')->references('id')->on('youth_members')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->integer('competence_id')->unsigned();
            $table->foreign('competence_id')->references('id')->on('competences')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->integer('school_prorogues_id')->unsigned();
            $table->foreign('school_prorogues_id')->references('id')->on('school_prorogues')
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
        Schema::drop('executive_details');
        Schema::drop('type_competences');
        Schema::drop('school_prorogues');
    }

}
