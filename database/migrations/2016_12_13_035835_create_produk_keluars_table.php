<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProdukKeluarsTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('produk_keluar', function(Blueprint $table) {
            $table->increments('id');
			$table->dateTime('tanggal');
			$table->unsignedSmallInteger('stok');
			$table->unsignedInteger('produk_id');
			$table->unsignedInteger('produk_detail_id');
			$table->unsignedInteger('pegawai_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('produk_keluar');
	}

}
