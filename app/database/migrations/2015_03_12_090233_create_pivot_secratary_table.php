<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePivotSecrataryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('secretary', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('union_id')->unsigned()->index();
            $table->foreign('union_id')->references('id')->on('youth_unions')->onDelete('cascade');
            $table->integer('secretary_id')->unsigned()->index();
            $table->foreign('secretary_id')->references('id')->on('youth_members')->onDelete('cascade');
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
		Schema::drop('secretary');
	}

}
