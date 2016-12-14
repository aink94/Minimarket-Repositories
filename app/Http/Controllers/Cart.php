<?php

namespace App\Http\Controllers;

use App\Repositories\ProdukRepository;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart as Carts;
use Illuminate\Support\Facades\Response;

class Cart extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function data()
    {
        if(request()->wantsJson()){
            $cart = Carts::Content();
            return fractal()
                ->collection($cart)
                ->transformWith(function($cart){
                    return [
                        'kode' => $cart->id,
                        'nama' => $cart->name,
                        'qty' => $cart->qty,
                        'harga' => number_format($cart->price, 2, '.', ','),
                        'subharga' => number_format(($cart->price * $cart->qty), 2, '.', ','),
                        'action' => '<button class="btn btn-danger btn-xs pull-right" onclick="removeitem('."'".$cart->rowId."'".', '."'".$cart->name."'".')"><i class="fa fa-trash"></i></button>'
                    ];
                })
                ->addMeta(['tagihan'=>Carts::subtotal()])
                ->toArray();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, ProdukRepository $repository)
    {
        if($request->wantsJson())
        {
            $produk_id = $repository->findByField('kode', $request->id)->first();
            $data = Carts::add([
                'id' => $request->id,
                'name' => $request->name,
                'qty' => $request->qty,
                'price' => $request->price,
                'options'=>[
                    'produk_id'=> $produk_id['id']
                ]
            ]);
            return Response()
                ->json([
                    'type' => 'success',
                    'title' => 'Berhasil dimasuk ke Cart',
                    'text' => $data
                ], 201);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Carts::remove($id);;

        return Response()
            ->json([
                'type' => 'success',
                'title' => 'Berhasil di hapus',
                'text' => "",
            ], 201);
    }

    public function totalbayar()
    {
        //return Response()->json(Cart::subtotal());
        return response()
            ->json(Carts::subtotal(), 200);
    }

    public function deletecart()
    {
        if(request()->wantsJson()){
            Carts::destroy();
            return Response()
                ->json([
                    'type' => 'success',
                    'title' => 'Cart Berhasil di Reset',
                    'text' => '',
                ], 201);
        }

    }
}
