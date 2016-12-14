<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Repositories\TransaksiDetailRepository;
use App\Validators\TransaksiDetailValidator;


class TransaksiDetailController extends Controller
{

    /**
     * @var TransaksiDetailRepository
     */
    protected $repository;

    /**
     * @var TransaksiDetailValidator
     */
    protected $validator;

    public function __construct(TransaksiDetailRepository $repository, TransaksiDetailValidator $validator)
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
        $transaksiDetails = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $transaksiDetails,
            ]);
        }

        return view('transaksiDetails.index', compact('transaksiDetails'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  TransaksiDetailCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(TransaksiDetailCreateRequest $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $transaksiDetail = $this->repository->create($request->all());

            $response = [
                'message' => 'TransaksiDetail created.',
                'data'    => $transaksiDetail->toArray(),
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
        $transaksiDetail = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $transaksiDetail,
            ]);
        }

        return view('transaksiDetails.show', compact('transaksiDetail'));
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

        $transaksiDetail = $this->repository->find($id);

        return view('transaksiDetails.edit', compact('transaksiDetail'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  TransaksiDetailUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(TransaksiDetailUpdateRequest $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $transaksiDetail = $this->repository->update($id, $request->all());

            $response = [
                'message' => 'TransaksiDetail updated.',
                'data'    => $transaksiDetail->toArray(),
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
                'message' => 'TransaksiDetail deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'TransaksiDetail deleted.');
    }
}
