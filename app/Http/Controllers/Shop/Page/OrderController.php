<?php

namespace App\Http\Controllers\Shop\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Shop\BaseController as BaseController;
use App\Repositories\OrderRepository;
use MetaTag;
use Auth;

class OrderController extends BaseController
{

    private $orderRepository;

    public function __construct() {

        $this->orderRepository = app(OrderRepository::class);

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        MetaTag::set('title', "Заказы | Аметист");

        return view('shop.pages.orders.index',[
            'orders' => $this->orderRepository->getUserOrders(Auth::user()->id, 5)
        ]);

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $order = $this->orderRepository->getOneOrderWithUserID(Auth::user()->id, $id);

        MetaTag::set('title', "Заказ {$order->unique_id} | Аметист");

        if(!$order){

            abort(404);

        }

        return view('shop.pages.orders.show', [
            'order' => $order
        ]);

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
