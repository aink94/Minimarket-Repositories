<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TambahFkProdukKeluar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('produk_keluar', function (Blueprint $table) {
            $table->foreign('produk_id')
                ->references('id')
                ->on('produk')
                ->onDelete('cascade');
            $table->foreign('produk_detail_id')
                ->references('id')
                ->on('produk_detail')
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
        Schema::table('produk_keluar', function (Blueprint $table) {
            $table->dropForeign('produk_keluar_produk_id_foreign');
            $table->dropForeign('produk_keluar_produk_detail_id_foreign');
            $table->dropForeign('produk_keluar_pegawai_id_foreign');
        });
    }
}
