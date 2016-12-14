<?php

namespace App\Http\Controllers;

use App\Model\ProdukKategori;
use App\Presenters\ProdukKategoriPresenter;
use Illuminate\Http\Request;

use App\Http\Requests;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Repositories\ProdukKategoriRepository;
use App\Validators\ProdukKategoriValidator;
use Spatie\Fractalistic\ArraySerializer;


class ProdukKategoriController extends Controller
{

    /**
     * @var ProdukKategoriRepository
     */
    protected $repository;

    /**
     * @var ProdukKategoriValidator
     */
    protected $validator;

    public function __construct(ProdukKategoriRepository $repository, ProdukKategoriValidator $validator)
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
        $this->repository->setPresenter(ProdukKategoriPresenter::class);
        $produkKategoris = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $produkKategoris,
            ]);
        }

        return view('kategori', compact('produkKategoris'));
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

            $produkKategori = $this->repository->create($request->all());

            $response = [
                'message' => 'ProdukKategori created.',
                'data'    => $produkKategori->toArray(),
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
        $produkKategori = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $produkKategori,
            ]);
        }

        return view('produkKategoris.show', compact('produkKategori'));
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

        $produkKategori = $this->repository->find($id);

        return view('produkKategoris.edit', compact('produkKategori'));
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

            $produkKategori = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'ProdukKategori updated.',
                'data'    => $produkKategori->toArray(),
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
                'message' => 'ProdukKategori deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'ProdukKategori deleted.');
    }

    public function carikategori(Request $request){
        $q = $request->q;
        $manager = new Manager();
        $manager->setSerializer(new ArraySerializer());

        $kategori = new ProdukKategori();

        $resource = new Collection($kategori->all()->toArray(), function(array $kategori) {
            return [
                'id'        => $kategori['id'],
                'nama'      => $kategori['nama'],
                'keterangan'=> $kategori['keterangan'],
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
