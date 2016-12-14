<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TambahFkProduk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('produk', function (Blueprint $table) {
            $table->foreign('kategori_id')
                ->references('id')
                ->on('produk_kategori')
                ->onDelete('cascade');
            $table->foreign('satuan_id')
                ->references('id')
                ->on('produk_satuan')
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
        Schema::table('produk', function (Blueprint $table) {
            $table->dropForeign('produk_kategori_id_foreign');
            $table->dropForeign('produk_satuan_id_foreign');
        });
    }
}
