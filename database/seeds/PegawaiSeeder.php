<?php

use Illuminate\Database\Seeder;

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pegawai = new \App\Model\Pegawai();
        $pegawai->nama = "Andi Hidayat";
        $pegawai->username = "kasir";
        $pegawai->password = "123456";
        $pegawai->status = "KASIR";
        $pegawai->save();

        $pegawai = new \App\Model\Pegawai();
        $pegawai->nama = "Cecep Zaenal Mustofa";
        $pegawai->username = "manager";
        $pegawai->password = "123456";
        $pegawai->status = "MANAGER";
        $pegawai->save();

        $pegawai = new \App\Model\Pegawai();
        $pegawai->nama = "Faisal Abdul Hamid";
        $pegawai->username = "admin";
        $pegawai->password = "123456";
        $pegawai->status = "ADMIN";
        $pegawai->save();
    }
}
