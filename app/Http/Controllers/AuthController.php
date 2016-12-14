<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Model\Pegawai as User;
use Illuminate\Support\Facades\URL;

class AuthController extends Controller
{
    public function getLogin()
    {
        return view('auth.login');
    }

    public function postLogin(Request $request, User $user)
    {
        if($request->wantsJson())
        {
            $this->validate($request, [
                'username' => 'required',
                'password'  => 'required'
            ]);

            $credential = $request->only('username', 'password');

            if(!Auth::attempt($credential, $request->has('remember')))
            {
                return Response()->json(['Username atau Password yang anda masukan salah'], 401);
            }

            $user = $user->find(Auth::user()->id);

            return response()->json([
                'intended' => URL::route('main'),
                'title'    => 'Selamat Anda telah masuk ke sistem'
            ], 200);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('get.login');
    }
}
