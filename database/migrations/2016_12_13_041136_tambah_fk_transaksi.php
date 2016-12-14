<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TambahFkTransaksi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transaksi', function (Blueprint $table) {
            $table->foreign('pelanggan_id')
                ->references('id')
                ->on('pelanggan')
                ->onDelete('cascade');
            $table->foreign('pegawai_id')
                ->references('id')
                ->on('pegawai')
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
        Schema::table('transaksi', function (Blueprint $table) {
            $table->dropForeign('transaksi_pelanggan_id_foreign');
            $table->dropForeign('transaksi_pegawai_id_foreign');
        });
    }
}
