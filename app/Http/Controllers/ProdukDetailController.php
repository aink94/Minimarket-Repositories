<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Repositories\ProdukDetailRepository;
use App\Validators\ProdukDetailValidator;


class ProdukDetailController extends Controller
{

    /**
     * @var ProdukDetailRepository
     */
    protected $repository;

    /**
     * @var ProdukDetailValidator
     */
    protected $validator;

    public function __construct(ProdukDetailRepository $repository, ProdukDetailValidator $validator)
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
        $produkDetails = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $produkDetails,
            ]);
        }

        return view('produkDetails.index', compact('produkDetails'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ProdukDetailCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ProdukDetailCreateRequest $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $produkDetail = $this->repository->create($request->all());

            $response = [
                'message' => 'ProdukDetail created.',
                'data'    => $produkDetail->toArray(),
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
        $produkDetail = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $produkDetail,
            ]);
        }

        return view('produkDetails.show', compact('produkDetail'));
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

        $produkDetail = $this->repository->find($id);

        return view('produkDetails.edit', compact('produkDetail'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  ProdukDetailUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(ProdukDetailUpdateRequest $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $produkDetail = $this->repository->update($id, $request->all());

            $response = [
                'message' => 'ProdukDetail updated.',
                'data'    => $produkDetail->toArray(),
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
                'message' => 'ProdukDetail deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'ProdukDetail deleted.');
    }
}
