<?php

namespace App\Http\Controllers;

use App\Presenters\ProdukMasukPresenter;
use App\Repositories\ProdukRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Repositories\ProdukMasukRepository;
use App\Validators\ProdukMasukValidator;


class ProdukMasukController extends Controller
{

    /**
     * @var ProdukMasukRepository
     */
    protected $repository;

    /**
     * @var ProdukMasukValidator
     */
    protected $validator;

    public function __construct(ProdukMasukRepository $repository, ProdukMasukValidator $validator)
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
        $this->repository->setPresenter(ProdukMasukPresenter::class);
        $produkMasuks = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $produkMasuks,
            ]);
        }

        return view('produkMasuk', compact('produkMasuks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, ProdukRepository $repository)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $produk = $repository->findByField('kode', $request->kode, ['id'])->first();

            $masuk = [
                'tanggal' => Carbon::now(),
                'stok'    => $request->stok,
                'produk_id' => $produk['id'],
                'produk_detail_id' => $request->produk_detail_id,
                'pegawai_id' => Auth::user()->id,
                'supplier_id' => ($request->supplier_id) ? $request->supplier_id : NULL,
            ];
            $produkMasuk = $this->repository->create($masuk);

            $response = [
                'message' => 'ProdukMasuk created.',
                'data'    => $produkMasuk//$produkMasuk->toArray(),
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
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $produkMasuk = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $produkMasuk,
            ]);
        }

        return view('produkMasuks.show', compact('produkMasuk'));
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

        $produkMasuk = $this->repository->find($id);

        return view('produkMasuks.edit', compact('produkMasuk'));
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

            $produkMasuk = $this->repository->update($id, $request->all());

            $response = [
                'message' => 'ProdukMasuk updated.',
                'data'    => $produkMasuk->toArray(),
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
                'message' => 'ProdukMasuk deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'ProdukMasuk deleted.');
    }
}
