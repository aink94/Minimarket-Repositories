<?php

namespace App\Http\Controllers;

use App\Criteria\OrderByStokDescCriteria;
use App\Model\ProdukDetail;
use App\Presenters\ProdukPilihPresenter;
use App\Presenters\ProdukPresenter;

use Illuminate\Http\Request;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Repositories\ProdukRepository;
use App\Validators\ProdukValidator;
use Spatie\Fractalistic\ArraySerializer;


class ProdukController extends Controller
{

    /**
     * @var ProdukRepository
     */
    protected $repository;

    /**
     * @var ProdukValidator
     */
    protected $validator;

    public function __construct(ProdukRepository $repository, ProdukValidator $validator)
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
        $this->repository->setPresenter(ProdukPresenter::class);

        $produks = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $produks,
            ]);
        }

        return view('produk', compact('produk'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Requests $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $produk = $this->repository->create($request->all());

            $response = [
                'message' => 'Produk created.',
                'data'    => $produk->toArray(),
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
        $produk = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $produk,
            ]);
        }

        return view('produk.show', compact('produk'));
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

        $produk = $this->repository->find($id);

        return view('produk.edit', compact('produk'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  Requests $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(Request $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $produk = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Produk updated.',
                'data'    => $produk->toArray(),
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
                'message' => 'Produk deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Produk deleted.');
    }


    public function pilih()
    {
        if(request()->wantsJson()){
            $this->repository->setPresenter(ProdukPilihPresenter::class);
            $pilih = $this->repository->all();

            return response()->json([
                'data' => $pilih,
            ]);
        }
    }

    public function caridetailitem(Request $request)
    {
        $q = $request->q;
        $data = [];

        if($request->produk_detail === "in"){
            $data = ['1', '3'];
        }else{
            $data = ['2'];
        }

        $manager = new Manager();
        $manager->setSerializer(new ArraySerializer());

        $detail = new ProdukDetail();

        $resource = new Collection($detail->whereIn('status', $data)->get()->toArray(), function(array $produk_detail){
            return [
                'id'        => $produk_detail['id'],
                'nama'      => $produk_detail['nama'],
                'deskripsi' => $produk_detail['deskripsi'],
            ];
        });

        $json = $manager->createData($resource)->toArray();

        $filtered = $json;
        if(strlen($q)) {
            $filtered = array_filter($json, function ($val) use ($q) {
                if (stripos($val['nama'], $q) !== false) {
                    return true;
                } else {
                    return false;
                }
            });
        }

        echo json_encode(array_slice(array_values($filtered), 0, 20));
    }

    public function check(Request $request)
    {
        if(request()->wantsJson()){
            $produk = $this->repository->findByField('kode', $request->kode, ['id', 'kode', 'nama', 'harga'])->first();
            if(empty($produk)){
                return Response()
                    ->json([
                        'type' => 'error',
                        'title' => '',
                        'title' => $request->kode.' tidak ada dalam database',
                    ], 404);
            }else{
                return Response()
                    ->json([
                        'type' => 'success',
                        'title' => '',
                        'title' => $request->kode.' ada dalam database',
                        'data' => $produk,
                    ], 200);

            }
        }
    }
}
