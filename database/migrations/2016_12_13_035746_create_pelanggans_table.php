<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePelanggansTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pelanggan', function(Blueprint $table) {
            $table->increments('id');
			$table->string('nama', 50);
			$table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
			$table->string('telepon', 20)->nullable();
			$table->string('alamat')->nullable();
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
		Schema::drop('pelanggan');
	}

}
