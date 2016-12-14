<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Repositories\PegawaiRepository;
use App\Validators\PegawaiValidator;


class PegawaiController extends Controller
{

    /**
     * @var PegawaiRepository
     */
    protected $repository;

    /**
     * @var PegawaiValidator
     */
    protected $validator;

    public function __construct(PegawaiRepository $repository, PegawaiValidator $validator)
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
        $pegawais = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $pegawais,
            ]);
        }

        return view('pegawais.index', compact('pegawais'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PegawaiCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(PegawaiCreateRequest $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $pegawai = $this->repository->create($request->all());

            $response = [
                'message' => 'Pegawai created.',
                'data'    => $pegawai->toArray(),
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
        $pegawai = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $pegawai,
            ]);
        }

        return view('pegawais.show', compact('pegawai'));
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

        $pegawai = $this->repository->find($id);

        return view('pegawais.edit', compact('pegawai'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  PegawaiUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(PegawaiUpdateRequest $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $pegawai = $this->repository->update($id, $request->all());

            $response = [
                'message' => 'Pegawai updated.',
                'data'    => $pegawai->toArray(),
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
                'message' => 'Pegawai deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Pegawai deleted.');
    }
}
