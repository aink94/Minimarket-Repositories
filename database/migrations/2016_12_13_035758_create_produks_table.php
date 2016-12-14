<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProduksTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('produk', function(Blueprint $table) {
            $table->increments('id');
			$table->string('kode')->unique();
			$table->string('nama', 50);
			$table->unsignedInteger('harga');
			$table->string('deskripsi')->nullable();
			$table->unsignedInteger('kategori_id');
			$table->unsignedInteger('satuan_id');
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
		Schema::drop('produk');
	}

}
