<?php

namespace App\Http\Controllers\Shop\Admin;

use App\Repositories\OrderRepository;
use App\Repositories\UserRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use MetaTag;

class UserController extends AdminBaseController
{

    private $orderRepository;
    private $userRepository;

    public function __construct() {

        parent::__construct();

        $this->orderRepository = app(OrderRepository::class);
        $this->userRepository = app(UserRepository::class);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        MetaTag::set('title', 'Пользователи');

        $perPage = 12;

        return view('shop.admin.users.index', [

            'users' => $this->userRepository->getAllUsers($perPage),
            'countUsers' => $this->userRepository->getCountUsers(),
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
        MetaTag::set('title', "Пользователь № {$id}");

        $perPage = 3;

        $user = $this->userRepository->getById($id);

        if(!empty($user)){

            return view('shop.admin.users.show', [

                'user' => $user,
                'userOrders' => $this->orderRepository->getUserOrders($id, $perPage),
                'countNewOrders' => $this->orderRepository->getCountNewOrders()

            ]);
        }
        else {

            abort(404);

        }

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
