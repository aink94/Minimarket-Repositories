<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\App\Repositories\PegawaiRepository::class, \App\Repositories\PegawaiRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\PelangganRepository::class, \App\Repositories\PelangganRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ProdukRepository::class, \App\Repositories\ProdukRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ProdukDetailRepository::class, \App\Repositories\ProdukDetailRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ProdukKategoriRepository::class, \App\Repositories\ProdukKategoriRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ProdukKeluarRepository::class, \App\Repositories\ProdukKeluarRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ProdukMasukRepository::class, \App\Repositories\ProdukMasukRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ProdukSatuanRepository::class, \App\Repositories\ProdukSatuanRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\SupplierRepository::class, \App\Repositories\SupplierRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\TransaksiRepository::class, \App\Repositories\TransaksiRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\TransaksiDetailRepository::class, \App\Repositories\TransaksiDetailRepositoryEloquent::class);
        //:end-bindings:
    }
}
