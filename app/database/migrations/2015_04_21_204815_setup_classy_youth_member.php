<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SetupClassyYouthMember extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//

        Schema::create('core_members' , function($table){
            $table->increments('id');
            $table->string('name');
            $table->boolean('is_confirm')->default(false);
            $table->integer('semester_id')->unsigned()->index();;
            $table->foreign('semester_id')->references('id')->on('semesters')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->date('begin_date');
            $table->date('end_date');
            $table->date('expired_date');
            $table->timestamps();
        });
        Schema::create('core_details' , function($table){
            $table->increments('id');
            $table->text('explain');
            $table->boolean('confirm')->default(false);
            $table->integer('list_id')->unsigned()->index();
            $table->foreign('list_id')->references('id')->on('core_members')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->integer('member_id')->unsigned()->index();
            $table->foreign('member_id')->references('id')->on('youth_members')
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
        Schema::drop('core_details');
        Schema::drop('core_members');
	}

}
