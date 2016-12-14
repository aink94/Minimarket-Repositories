<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProdukDetailsTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('produk_detail', function(Blueprint $table) {
            $table->increments('id');
			$table->string('nama', 20);
			$table->string('deskripsi')->nullable();
			$table->char('status')->default('2');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('produk_detail');
	}

}
