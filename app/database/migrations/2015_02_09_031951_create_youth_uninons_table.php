<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateYouthUninonsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('youth_unions', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('name');
            $table->integer('type_id');
            $table->string('union_id');
            $table->boolean('active')->default(true);
            //Co can quan ly chi doan nao khong nhi ?

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
		Schema::drop('youth_unions');
	}

}
