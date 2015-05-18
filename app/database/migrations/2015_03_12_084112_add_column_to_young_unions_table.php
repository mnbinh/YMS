<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToYoungUnionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('youth_unions', function(Blueprint $table)
		{
			//$
            $table->string('union_id');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('youth_unions', function(Blueprint $table)
		{
			//$
            $table->dropColumn('union_id')->unique();
		});
	}

}
