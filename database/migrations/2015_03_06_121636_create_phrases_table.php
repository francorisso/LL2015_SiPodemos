<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhrasesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create("phrases", function($table){
			$table->increments("id");
			$table->integer("user_id")->unsigned();
			$table->foreign("user_id")
			->references("id")->on("users")
			->onDelete("cascade")
			->onUpdate("cascade");
			$table->string("phrase",400);
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
	}

}
