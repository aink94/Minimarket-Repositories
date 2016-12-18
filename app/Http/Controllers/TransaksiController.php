<?php

namespace App\Http\Controllers;

use App\Model\ProdukKeluar;
use App\Model\Transaksi;
use App\Repositories\PelangganRepository;
use App\Repositories\ProdukKeluarRepository;
use App\Repositories\TransaksiDetailRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Repositories\TransaksiRepository;
use App\Validators\TransaksiValidator;


class TransaksiController extends Controller
{

    /**
     * @var TransaksiRepository
     */
    protected $repository;

    /**
     * @var TransaksiValidator
     */
    protected $validator;

    public function __construct(TransaksiRepository $repository, TransaksiValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $transaksis = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $transaksis,
            ]);
        }

        return view('transaksi', compact('transaksis'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function bayartunai(Request $request, TransaksiDetailRepository $detailRepository, ProdukKeluarRepository $keluarRepository)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $bayar = [
                'kode' => $request->kode,
                'tanggal' => Carbon::now(),
                //'pelanggan_id' => ,
                'pegawai_id' => Auth::user()->id
            ];
            $transaksi = $this->repository->create($bayar);

            //detail-transaksi
            $cart = Cart::Content();
            foreach($cart as $c){
                //detail transaksi
                $detailRepository->create([
                    'produk_id'=>$c->options->produk_id,
                    'transaksi_id'=>$transaksi['id']
                ]);

                //produk keluar
                $keluar = [
                    'tanggal' => $bayar['tanggal'],
                    'stok' => $c->qty,
                    'produk_id' => $c->options->produk_id,
                    'produk_detail_id' => 2, // id penjualan
                    'pegawai_id' => Auth::user()->id
                ];
                $keluarRepository->create($keluar);
            }

            $response = [
                'message' => 'Transaksi created.',
                'data'    => $transaksi,
            ];

            if ($request->wantsJson()) {

                return response()->json($response, 201);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ], 422);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }
    public function bayarrfid(Request $request, PelangganRepository $pelangganRepository, TransaksiDetailRepository $detailRepository, ProdukKeluarRepository $keluarRepository)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);
            //
//            $pelanggan = [
//                'nama' => $request->nama,
//                'jenis_kelamin' => ($request->jenis_kelamin) ? $request->jenis_kelamin : 'Laki-laki',
//                'telepon' => ($request->telepon) ? $request->telepon : NULL,
//                'alamat' => ($request->alamat) ? $request->alamat : NULL,
//            ];
//            $pelanggan = $pelangganRepository->updateOrCreate($pelanggan);

            $bayar = [
                'kode' => $request->kode,
                'tanggal' => Carbon::now(),
                'status_pembayaran' => 'BAYAR KARTU',
                //'pelanggan_id' => ($pelanggan) ? $pelanggan['id'] : NULL,
                'pegawai_id' => Auth::user()->id
            ];

            $transaksi = $this->repository->create($bayar);
            //
            //detail-transaksi
            $cart = Cart::Content();
            foreach($cart as $c){
                //detail transaksi
                $detailRepository->create([
                    'produk_id'=>$c->options->produk_id,
                    'transaksi_id'=>$transaksi['id']
                ]);

                //produk keluar
                $keluar = [
                    'tanggal' => $bayar['tanggal'],
                    'stok' => $c->qty,
                    'produk_id' => $c->options->produk_id,
                    'produk_detail_id' => 2, // id penjualan
                    'pegawai_id' => Auth::user()->id
                ];
                $keluarRepository->create($keluar);
            }



            $response = [
                'message' => 'Transaksi created.',
                'data'    => $transaksi->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response, 201);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ], 422);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transaksi = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $transaksi,
            ]);
        }

        return view('transaksis.show', compact('transaksi'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $transaksi = $this->repository->find($id);

        return view('transaksis.edit', compact('transaksi'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(Request $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $transaksi = $this->repository->update($id, $request->all());

            $response = [
                'message' => 'Transaksi updated.',
                'data'    => $transaksi->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Transaksi deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Transaksi deleted.');
    }

    public function kodetransaksi()
    {
        $transaksi = new Transaksi();
        $date = Carbon::now();
        $id = $transaksi->max('id');

        return Response()
            ->json([
                'kode' => sprintf('TR'.'%0' . 6 .'s-%s', ($id) ? intval($id) + 1 : 1, $date->format('Y/m/d')),
                'tgl' => $date->format('Y-m-d H:i:s'),
            ], 200);
    }
}
