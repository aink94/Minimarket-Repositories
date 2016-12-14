<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TambahFkTransaksiDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transaksi_detail', function (Blueprint $table) {
             $table->foreign('produk_id')
                 ->references('id')
                 ->on('produk')
                 ->onDelete('cascade');
             $table->foreign('transaksi_id')
                 ->references('id')
                 ->on('transaksi')
                 ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transaksi_detail', function (Blueprint $table) {
             $table->dropForeign('transaksi_detail_produk_id_foreign');
             $table->dropForeign('transaksi_detail_transaksi_id_foreign');
        });
    }
}
