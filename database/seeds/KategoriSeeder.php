<?php

use App\Model\ProdukKategori;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kategori1 = new ProdukKategori();
        $kategori1->nama = 'ART';
        $kategori1->keterangan = null;
        $kategori1->save();

        $kategori2 = new ProdukKategori();
        $kategori2->nama = 'ATK';
        $kategori2->keterangan = 'Alat Tulis Kantor';
        $kategori2->save();

        $kategori3 = new ProdukKategori();
        $kategori3->nama = 'LL';
        $kategori3->keterangan = null;
        $kategori3->save();

        $kategori4 = new ProdukKategori();
        $kategori4->nama = 'MKN';
        $kategori4->keterangan = 'Makanaan';
        $kategori4->save();

        $kategori5 = new ProdukKategori();
        $kategori5->nama = 'MNM';
        $kategori5->keterangan = 'Minuman';
        $kategori5->save();

        $kategori6 = new ProdukKategori();
        $kategori6->nama = 'OBT';
        $kategori6->keterangan = 'Obat';
        $kategori6->save();
    }
}
