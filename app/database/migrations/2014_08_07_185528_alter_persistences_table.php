<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPersistencesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('persistences', function(Blueprint $table)
		{
			$table->string('version')->after('code');
			$table->string('browser')->after('version');
			$table->string('platform')->after('browser');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('persistences', function(Blueprint $table)
		{
			$table->dropColumn('version');
			$table->dropColumn('browser');
			$table->dropColumn('platform');
		});
	}

}
