<?php

namespace App\Http\Controllers;

use App\Model\ProdukSatuan;
use App\Presenters\ProdukSatuanPresenter;
use Illuminate\Http\Request;

use App\Http\Requests;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Repositories\ProdukSatuanRepository;
use App\Validators\ProdukSatuanValidator;
use Spatie\Fractalistic\ArraySerializer;


class ProdukSatuanController extends Controller
{

    /**
     * @var ProdukSatuanRepository
     */
    protected $repository;

    /**
     * @var ProdukSatuanValidator
     */
    protected $validator;

    public function __construct(ProdukSatuanRepository $repository, ProdukSatuanValidator $validator)
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
        $this->repository->setPresenter(ProdukSatuanPresenter::class);
        $produkSatuans = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $produkSatuans,
            ]);
        }

        return view('satuan', compact('produkSatuans'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $produkSatuan = $this->repository->create($request->all());

            $response = [
                'message' => 'ProdukSatuan created.',
                'data'    => $produkSatuan->toArray(),
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
        $produkSatuan = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $produkSatuan,
            ]);
        }

        return view('produkSatuans.show', compact('produkSatuan'));
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

        $produkSatuan = $this->repository->find($id);

        return view('produkSatuans.edit', compact('produkSatuan'));
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

            $produkSatuan = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'ProdukSatuan updated.',
                'data'    => $produkSatuan->toArray(),
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
                'message' => 'ProdukSatuan deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'ProdukSatuan deleted.');
    }


    public function carisatuan(Request $request)
    {
        $q = $request->q;
        $manager = new Manager();
        $manager->setSerializer(new ArraySerializer());

        $satuan = new ProdukSatuan();

        $resource = new Collection($satuan->all()->toArray(), function(array $satuan) {
            return [
                'id'        => $satuan['id'],
                'nama'      => $satuan['nama'],
                'keterangan'=> $satuan['keterangan'],
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
}
