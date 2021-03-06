<?php

use App\Model\ProdukDetail;
use Illuminate\Database\Seeder;

class DetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $detail1 = new ProdukDetail;
        $detail1->nama = 'Penambahan Stok';
        $detail1->deskripsi = null;
        $detail1->status = '1';
        $detail1->save();

        $detail2 = new ProdukDetail;
        $detail2->nama = 'Penjualan';
        $detail2->deskripsi = null;
        $detail2->status = '2';
        $detail2->save();

        $detail3 = new ProdukDetail;
        $detail3->nama = 'Hilang';
        $detail3->deskripsi = null;
        $detail3->status = '2';
        $detail3->save();

        $detail4 = new ProdukDetail;
        $detail4->nama = 'Kadaluarsa';
        $detail4->deskripsi = null;
        $detail4->status = '2';
        $detail4->save();

        $detail5 = new ProdukDetail;
        $detail5->nama = 'Rusak';
        $detail5->deskripsi = null;
        $detail5->status = '2';
        $detail5->save();

        $detail6 = new ProdukDetail;
        $detail6->nama = 'Lainnya';
        $detail6->deskripsi = null;
        $detail6->status = '3';
        $detail6->save();
    }
}
