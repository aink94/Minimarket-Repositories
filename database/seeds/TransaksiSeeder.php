<?php

use App\Model\Transaksi;
use Illuminate\Database\Seeder;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $transaksi = new Transaksi;
        foreach($transaksi->all() as $t){
            $banyak = rand(1, 5);
            for($i= 0; $i<$banyak ; $i++){
                $transaksi_detail = new \App\Model\TransaksiDetail();
                $transaksi_detail->produk_id = \App\Model\Produk::inRandomOrder()->first()['id'];
                $transaksi_detail->transaksi_id = $t['id'];
                $transaksi_detail->save();
            }
        }
    }
}
