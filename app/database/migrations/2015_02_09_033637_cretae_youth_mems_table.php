<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CretaeYouthMemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('youth_members', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->date('date_of_bird');
            $table->boolean('are_member')->default(true);
	        $table->boolean('gender');
            $table->integer('type_id');
            $table->string('student_id');
            $table->integer('youth_union_id');
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
		Schema::drop('youth_members');
	}

}
