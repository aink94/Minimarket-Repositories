<?php

Route::group(['middleware'=>'web'], function(){
	Route::get('login', [
		'uses' => 'AuthController@getLogin',
		'as'   => 'get.login'
	]);
	Route::post('login', [
		'uses' => 'AuthController@postLogin',
		'as'   => 'post.login'
	]);
	Route::get('logout', [
		'uses' => 'AuthController@logout',
		'as'   => 'logout'
	]);
});

Route::group(['middleware'=>'auth'], function(){
	Route::get('', [
		'uses' => 'MainController@index',
		'as'   => 'main'
	]);
});

Route::group(['middleware'=>'auth', 'prefix'=>'produk'], function(){
	Route::get('', [
		'uses' => 'ProdukController@index',
		'as'   => 'produk'
	]);
	Route::get('data/{id}', [
		'uses' => 'ProdukController@show',
		'as'   => 'produk.data'
	]);
	Route::get('pilih', [
		'uses' => 'ProdukController@pilih',
		'as'   => 'produk.pilih'
	]);
	Route::post('produk-detail', [
		'uses' => 'ProdukController@caridetailitem',
		'as'   => 'produk.detail'
	]);
	Route::post('cari-item', [
		'uses' => 'ProdukController@check',
		'as'   => 'produk.cari.item'
	]);
	Route::post('tambah', [
		'uses' => 'ProdukController@store',
		'as'   => 'produk.tambah'
	]);
	Route::post('ubah/{id}', [
		'uses' => 'ProdukController@update',
		'as'   => 'produk.ubah'
	]);
	Route::post('hapus/{id}', [
		'uses' => 'ProdukController@destroy',
		'as'   => 'produk.hapus'
	]);
});

Route::group(['middleware'=>'auth', 'prefix'=>'kategori'], function(){
	Route::get('', [
		'uses' => 'ProdukKategoriController@index',
		'as'   => 'kategori'
	]);
	Route::get('data/{id}', [
		'uses' => 'ProdukKategoriController@show',
		'as'   => 'kategori.data'
	]);
	Route::post('cari',[
		'uses'=>'ProdukKategoriController@carikategori',
		'as'=>'kategori.cari'
	]);
	Route::post('tambah', [
		'uses' => 'ProdukKategoriController@store',
		'as'   => 'kategori.tambah'
	]);
	Route::post('ubah/{id}', [
		'uses' => 'ProdukKategoriController@update',
		'as'   => 'kategori.ubah'
	]);
	Route::post('hapus/{id}', [
		'uses' => 'ProdukKategoriController@destroy',
		'as'   => 'kategori.hapus'
	]);
});

Route::group(['middleware'=>'auth', 'prefix'=>'satuan'], function(){
	Route::get('', [
		'uses' => 'ProdukSatuanController@index',
		'as'   => 'satuan'
	]);
	Route::get('data/{id}', [
		'uses' => 'ProdukSatuanController@show',
		'as'   => 'satuan.data'
	]);
	Route::post('cari',[
		'uses' => 'ProdukSatuanController@carisatuan',
		'as'   => 'satuan.cari'
	]);
	Route::post('tambah', [
		'uses' => 'ProdukSatuanController@store',
		'as'   => 'satuan.tambah'
	]);
	Route::post('ubah/{id}', [
		'uses' => 'ProdukSatuanController@update',
		'as'   => 'satuan.ubah'
	]);
	Route::post('hapus/{id}', [
		'uses' => 'ProdukSatuanController@destroy',
		'as'   => 'satuan.hapus'
	]);
});

Route::group(['middleware'=>'auth', 'prefix'=>'stok'], function(){
	Route::group(['prefix'=>'masuk'], function(){
		Route::get('', [
			'uses' => 'ProdukMasukController@index',
			'as'   => 'stok.masuk'
		]);
		Route::get('data/{id}', [
			'uses' => 'ProdukMasukController@show',
			'as'   => 'stok.masuk.data'
		]);
		Route::post('tambah', [
			'uses' => 'ProdukMasukController@store',
			'as'   => 'stok.masuk.tambah'
		]);
		Route::post('ubah/{id}', [
			'uses' => 'ProdukMasukController@update',
			'as'   => 'stok.masuk.ubah'
		]);
		Route::post('hapus/{id}', [
			'uses' => 'ProdukMasukController@destroy',
			'as'   => 'stok.masuk.hapus'
		]);
	});
	Route::group(['prefix'=>'keluar'], function(){
		Route::get('', [
			'uses' => 'ProdukKeluarController@index',
			'as'   => 'stok.keluar'
		]);
		Route::get('data/{id}', [
			'uses' => 'ProdukKeluarController@show',
			'as'   => 'stok.keluar.data'
		]);
		Route::post('tambah', [
			'uses' => 'ProdukKeluarController@store',
			'as'   => 'stok.keluar.tambah'
		]);
		Route::post('ubah/{id}', [
			'uses' => 'ProdukKeluarController@update',
			'as'   => 'stok.keluar.ubah'
		]);
		Route::post('hapus/{id}', [
			'uses' => 'ProdukKeluarController@destroy',
			'as'   => 'stok.keluar.hapus'
		]);
	});
});

Route::group(['middleware'=>'auth', 'prefix'=>'pelanggan'], function(){
	Route::get('', [
		'uses' => 'PelangganController@index',
		'as'   => 'pelanggan'
	]);
	Route::get('data/{id}', [
		'uses' => 'PelangganController@show',
		'as'   => 'pelanggan.data'
	]);
	Route::post('tambah', [
		'uses' => 'PelangganController@store',
		'as'   => 'pelanggan.tambah'
	]);
	Route::post('ubah/{id}', [
		'uses' => 'PelangganController@update',
		'as'   => 'pelanggan.ubah'
	]);
	Route::post('hapus/{id}', [
		'uses' => 'PelangganController@destroy',
		'as'   => 'pelanggan.hapus'
	]);
});

Route::group(['middleware'=>'auth', 'prefix'=>'supplier'], function(){
	Route::get('', [
		'uses' => 'SupplierController@index',
		'as'   => 'supplier'
	]);
	Route::get('data/{id}', [
		'uses' => 'SupplierController@show',
		'as'   => 'supplier.data'
	]);
	Route::post('tambah', [
		'uses' => 'SupplierController@store',
		'as'   => 'supplier.tambah'
	]);
	Route::post('ubah/{id}', [
		'uses' => 'SupplierController@update',
		'as'   => 'supplier.ubah'
	]);
	Route::post('hapus/{id}', [
		'uses' => 'SupplierController@destroy',
		'as'   => 'supplier.hapus'
	]);
});

Route::group(['middleware'=>'auth', 'prefix'=>'laporan'], function(){
	Route::group(['prefix'=>'penjualan'], function(){
		Route::get('', [
			'uses' => 'LaporanController@penjualan',
			'as'   => 'laporan.penjualan'
		]);
	});
	Route::group(['prefix'=>'stokmasuk'], function(){
		Route::get('', [
			'uses' => 'LaporanController@stokmasuk',
			'as'   => 'laporan.stok.masuk'
		]);
	});
	Route::group(['prefix'=>'stokkeluar'], function(){
		Route::get('', [
			'uses' => 'LaporanController@stokkeluar',
			'as'   => 'laporan.stok.keluar'
		]);
	});
});

Route::group(['middleware'=>'auth', 'prefix'=>'transaksi'], function(){
	Route::get('', [
		'uses' => 'TransaksiController@index',
		'as'   => 'transaksi'
	]);
	Route::get('kode-transaksi', [
		'uses' => 'TransaksiController@kodetransaksi',
		'as'   => 'transaksi.kode'
	]);
	Route::post('bayar-tunai', [
		'uses' => 'TransaksiController@bayartunai',
		'as'   => 'bayar.tunai'
	]);
	Route::post('bayar-rfid', [
		'uses' => 'TransaksiController@bayarrfid',
		'as'   => 'bayar.rfid'
	]);
	Route::group(['prefix'=>'cart'], function(){
		Route::get('data', [
			'uses' => 'Cart@data',
			'as'   => 'cart.data',
		]);
		Route::post('tambah', [
			'uses' => 'Cart@store',
			'as'   => 'cart.tambah',
		]);
		Route::post('hapus/{id}', [
			'uses' => 'Cart@destroy',
			'as'   => 'cart.hapus',
		]);
		Route::post('clear', function(){
			\Gloudemans\Shoppingcart\Facades\Cart::destroy();
		});
		Route::get('total-bayar', [
			'uses' => 'Cart@totalbayar',
			'as'   => 'cart.total.bayar'
		]);
	});
});