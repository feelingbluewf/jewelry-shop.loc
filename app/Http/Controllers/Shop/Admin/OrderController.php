<?php

namespace App\Http\Controllers\Shop\Admin;

use App\Repositories\OrderRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use MetaTag;

class OrderController extends AdminBaseController
{

    private $orderRepository;

    public function __construct() {

        parent::__construct();

        $this->orderRepository = app(OrderRepository::class);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        MetaTag::set('title', 'Заказы');

        $perPage = 12;

        return view('shop.admin.orders.index', [

            'orders' => $this->orderRepository->getAllOrders($perPage),
            'countOrders' => $this->orderRepository->getCountOrders(),
            'countNewOrders' => $this->orderRepository->getCountNewOrders()

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

        $order = $this->orderRepository->getOneOrder($id);

        if(empty($order)) {

            abort(404);

        }
        else {

            MetaTag::set('title', "Заказ № {$id}");

            return view('shop.admin.orders.edit', [
                'order' => $order,
                'countNewOrders' => $this->orderRepository->getCountNewOrders(),
            ]);

        }

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

        if($this->orderRepository->addNote($id, $request->note)) {

            return redirect()->back()->withSuccess("Комментарий обновлен!");

        }
        else {

            return redirect()->back()->withErrors("Не удалось обновить комментарий!");

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
        //
    }

    public function approve($id)
    {

        if($this->orderRepository->approveOrder($id)) {

            return redirect()->back()->withSuccess("Заказ № {$id} Одобрен!");

        }
        else {

            return redirect()->back()->withErrors("Не удалось одобрить заказ № {$id}!");

        }

    }

    public function returnToRevision($id) {

        if($this->orderRepository->returnToRevision($id)) {

            return redirect()->back()->withSuccess("Заказ № {$id} вернулся на доработку!");

        }

        else {

            return redirect()->back()->withErrors("Не удалось вернуть на доработку заказ № {$id}!");

        }

    }

    public function delivered($id) {

        if($this->orderRepository->delivered($id)) {

            return redirect()->back()->withSuccess("Заказ № {$id} доставлен!");

        }
        else {

            return redirect()->back()->withErrors("Не удалось поменять статус заказа № {$id}!");

        }

    }

    public function delete($id)
    {

        if($this->orderRepository->deleteOrder($id)) {

            return redirect('/admin/orders/')->withSuccess("Заказ № {$id} успешно удален!");

        }
        else {

            return redirect('/admin/orders/')->withErrors("Не удалось удалить заказ № {$id}!");

        }
    }
}
