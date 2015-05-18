<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateShiftYouthMemberTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('shift_youth_member', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('shift_id')->unsigned()->index();
			$table->foreign('shift_id')->references('id')->on('shifts')->onDelete('cascade');
			$table->integer('youth_member_id')->unsigned()->index();
			$table->foreign('youth_member_id')->references('id')->on('youth_members')->onDelete('cascade');
            $table->boolean('absent')->default(false);

		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('shift_youth_member');
	}

}
