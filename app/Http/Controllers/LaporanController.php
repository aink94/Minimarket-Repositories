<?php

namespace App\Http\Controllers;

use App\Repositories\ProdukKeluarRepository;
use App\Repositories\ProdukMasukRepository;
use App\Repositories\TransaksiRepository;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    protected $stokmasuk;
    protected $stokkeluar;
    protected $penjualan;

    public function __construct(ProdukMasukRepository $stokmasuk, ProdukKeluarRepository $stokkeluar, TransaksiRepository $penjualan)
    {
        $this->stokmasuk = $stokmasuk;
        $this->stokkeluar = $stokkeluar;
        $this->penjualan = $penjualan;
    }

    public function penjualan()
    {
        $this->penjualan->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $penjualan = $this->penjualan->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $penjualan,
            ]);
        }

        return view('laporan.penjualan', compact('penjualan'));
    }

    public function stokmasuk()
    {
        $this->stokmasuk->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $stokmasuk = $this->stokmasuk->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $stokmasuk,
            ]);
        }

        return view('laporan.stokmasuk', compact('stokmasuk'));
    }

    public function stokkeluar()
    {
        $this->stokkeluar->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $stokkeluar = $this->stokkeluar->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $stokkeluar,
            ]);
        }

        return view('laporan.stokkeluar', compact('stokkeluar'));
    }
}
