<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PhrasesAddVotes extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('phrases', function($table)
		{
		    $table->integer('votes');
		    $table->index('votes');
		});

		Schema::create('phrases_votes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer("user_id")->unsigned();
			$table->foreign("user_id")
			->references("id")->on("users")
			->onDelete("cascade")
			->onUpdate("cascade");

			$table->integer("phrase_id")->unsigned();
			$table->foreign("phrase_id")
			->references("id")->on("phrases")
			->onDelete("cascade")
			->onUpdate("cascade");
			
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
