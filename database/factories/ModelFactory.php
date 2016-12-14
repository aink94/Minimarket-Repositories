<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\Model\Pegawai::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Model\Produk::class, function (Faker\Generator $faker) {
    return [
        'kode' => $faker->unique()->ean13,
        'nama' => $faker->word,
        'harga' => rand(1000, 5000),
        'deskripsi' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'kategori_id' => rand(1, 6),
        'satuan_id' => rand(1, 5)
    ];
});

$factory->define(App\Model\Pelanggan::class, function (Faker\Generator $faker) {
    return [
        'nama'=> $faker->name,
        'jenis_kelamin'=> ['Laki-laki', 'Perempuan'][rand(0,1)],
        'telepon'=> $faker->e164PhoneNumber,
        'alamat'=> $faker->address
    ];
});

$factory->define(App\Model\Supplier::class, function (Faker\Generator $faker) {
    return [
        'nama'=> $faker->name,
        'deskripsi'=> $faker->text($maxNbChars = 200),
        'telepon'=> $faker->e164PhoneNumber,
        'alamat'=> $faker->address
    ];
});

$factory->define(App\Model\ProdukMasuk::class, function (Faker\Generator $faker) {
    $supplier_id = \App\Model\Supplier::inRandomOrder()->first()['id'];
    $pegawai_id = \App\Model\Pegawai::inRandomOrder()->first()['id'];
    $produk_id = \App\Model\Produk::inRandomOrder()->first()['id'];

    return [
        'tanggal'=>$faker->dateTimeThisYear($max = 'now'),
        'stok'=>rand(20, 100),
        'produk_id'=>$produk_id,
        'produk_detail_id'=> 1,
        'pegawai_id'=>$pegawai_id,
        'supplier_id'=>$supplier_id
    ];
});

$factory->define(App\Model\ProdukKeluar::class, function (Faker\Generator $faker) {
    $pegawai_id = \App\Model\Pegawai::inRandomOrder()->first()['id'];
    $produk_id = \App\Model\Produk::inRandomOrder()->first()['id'];

    return [
        'tanggal'=>$faker->dateTimeThisYear($max = 'now'),
        'stok'=>rand(5, 20),
        'produk_id'=>$produk_id,
        'produk_detail_id'=> rand(2, 6),
        'pegawai_id'=>$pegawai_id,
    ];
});

$factory->define(App\Model\Transaksi::class, function (Faker\Generator $faker) {
    $pegawai_id = \App\Model\Pegawai::inRandomOrder()->first()['id'];
    $pelanggan_id = \App\Model\Pelanggan::inRandomOrder()->first()['id'];

    return [
        'kode'=>$faker->unique()->ean8,
        'tanggal'=>$faker->dateTimeThisYear($max = 'now'),
        'pelanggan_id'=>$pelanggan_id,
        'pegawai_id'=>$pegawai_id
    ];
});
