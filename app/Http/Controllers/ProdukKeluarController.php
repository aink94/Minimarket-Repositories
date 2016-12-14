<?php

namespace App\Http\Controllers;

use App\Presenters\ProdukKeluarPresenter;
use App\Repositories\ProdukRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Repositories\ProdukKeluarRepository;
use App\Validators\ProdukKeluarValidator;


class ProdukKeluarController extends Controller
{

    /**
     * @var ProdukKeluarRepository
     */
    protected $repository;

    /**
     * @var ProdukKeluarValidator
     */
    protected $validator;

    public function __construct(ProdukKeluarRepository $repository, ProdukKeluarValidator $validator)
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
        $this->repository->setPresenter(ProdukKeluarPresenter::class);
        $produkKeluars = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $produkKeluars,
            ]);
        }

        return view('produkKeluar', compact('produkKeluars'));
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

            $keluar = [
                'tanggal' => Carbon::now(),
                'stok'   => $request->stok,
                'produk_id' => $produk['id'],
                'produk_detail_id' => $request->produk_detail_id,
                'pegawai_id'  => Auth::user()->id,
            ];

            $produkKeluar = $this->repository->create($keluar);

            $response = [
                'message' => 'ProdukKeluar created.',
                'data'    => $produkKeluar->toArray(),
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
        $produkKeluar = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $produkKeluar,
            ]);
        }

        return view('produkKeluars.show', compact('produkKeluar'));
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

        $produkKeluar = $this->repository->find($id);

        return view('produkKeluars.edit', compact('produkKeluar'));
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

            $produkKeluar = $this->repository->update($id, $request->all());

            $response = [
                'message' => 'ProdukKeluar updated.',
                'data'    => $produkKeluar->toArray(),
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
                'message' => 'ProdukKeluar deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'ProdukKeluar deleted.');
    }
}
