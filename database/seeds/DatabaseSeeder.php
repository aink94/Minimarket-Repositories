<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PegawaiSeeder::class);
        $this->call(DetailSeeder::class);
        $this->call(KategoriSeeder::class);
        $this->call(SatuanSeeder::class);
        factory(\App\Model\Pelanggan::class, 200)->create();
        factory(\App\Model\Supplier::class, 20)->create();
        factory(\App\Model\Produk::class, 500)->create();

        factory(\App\Model\ProdukMasuk::class, 100)->create();
        factory(\App\Model\ProdukKeluar::class, 100)->create();
        //factory(\App\Model\Transaksi::class, 100)->create();
        //$this->call(TransaksiSeeder::class);
    }
}
