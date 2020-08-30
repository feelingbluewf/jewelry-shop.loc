<?php

namespace App\Http\Controllers\Shop\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Shop\BaseController as BaseController;
use MetaTag;

class CartController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        MetaTag::set('title', 'Корзина | Аметист');
        
        return view('shop.pages.cart.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if($request->cart) {

            $cart = json_decode($request->cart, true);

            $cart_arr = [];

            foreach ($cart as $key => $value) {
                
                $cart_arr[] = ['id' => $key, 'price' => $value['price'], 'quantity' => $value['quantity'], 'title' => $value['title'], 'total' => $value['total']]; 

            }

            \Session::forget('cart');
            \Session::put('cart', $cart_arr);

        }

        if(\Session::get('cart')) {

            return redirect(route('checkout'));

        } 
        else {

            abort(404);

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
