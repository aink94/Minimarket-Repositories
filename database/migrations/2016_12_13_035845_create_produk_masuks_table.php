<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProdukMasuksTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('produk_masuk', function(Blueprint $table) {
            $table->increments('id');
			$table->dateTime('tanggal');
			$table->unsignedSmallInteger('stok');
			$table->unsignedInteger('produk_id');
			$table->unsignedInteger('produk_detail_id');
			$table->unsignedInteger('pegawai_id');
			$table->unsignedInteger('supplier_id')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('produk_masuk');
	}

}
