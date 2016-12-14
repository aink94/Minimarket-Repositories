<?php

namespace App\Http\Controllers;

use App\Presenters\PelangganPresenter;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Repositories\PelangganRepository;
use App\Validators\PelangganValidator;


class PelangganController extends Controller
{

    /**
     * @var PelangganRepository
     */
    protected $repository;

    /**
     * @var PelangganValidator
     */
    protected $validator;

    public function __construct(PelangganRepository $repository, PelangganValidator $validator)
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
        $this->repository->setPresenter(PelangganPresenter::class);
        $pelanggans = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $pelanggans,
            ]);
        }

        return view('pelanggan', compact('pelanggans'));
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

            $pelanggan = $this->repository->create($request->all());

            $response = [
                'message' => 'Pelanggan created.',
                'data'    => $pelanggan->toArray(),
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
        $pelanggan = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $pelanggan,
            ]);
        }

        return view('pelanggans.show', compact('pelanggan'));
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

        $pelanggan = $this->repository->find($id);

        return view('pelanggans.edit', compact('pelanggan'));
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

            $pelanggan = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Pelanggan updated.',
                'data'    => $pelanggan->toArray(),
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
                'message' => 'Pelanggan deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Pelanggan deleted.');
    }
}
