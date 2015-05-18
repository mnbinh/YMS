<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SetupUpUnionFee extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
        Schema::create('type_fees' , function($table){
            $table->increments('id');
            $table->string('name');
        });
        Schema::create('year_fees' , function($table){
            $table->increments('id');
            $table->string('year');
        });
        Schema::create('month_fees', function ($table) {
            $table->increments('id');
            $table->string('month');
            $table->integer('fee')->default(0);
            $table->integer('year_id')->unsigned();
            $table->foreign('year_id')->references('id')->on('year_fees')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->integer('type_id')->unsigned();
            $table->foreign('type_id')->references('id')->on('type_fees')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();


        });

        Schema::create('pays', function ($table) {
            $table->increments('id');
            $table->integer('month_fee_id');
            $table->integer('pay_id')->unsigned()->index();
            $table->string('pay_type');
            $table->boolean('check')->defaul(false);

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


        Schema::drop('pays');
        Schema::drop('month_fees');
        Schema::drop('type_fees');
        Schema::drop('year_fees');



    }

}
