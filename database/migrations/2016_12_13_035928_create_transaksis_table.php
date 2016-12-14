<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransaksisTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('transaksi', function(Blueprint $table) {
            $table->increments('id');
			$table->string('kode')->unique();
			$table->dateTime('tanggal');
			$table->enum('status_pembayaran', ['BAYAR TUNAI', 'BAYAR KARTU'])->default('BAYAR TUNAI');
			$table->unsignedInteger('pelanggan_id')->nullable();
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
		Schema::drop('transaksi');
	}

}
