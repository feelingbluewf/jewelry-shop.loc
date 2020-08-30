<?php

namespace App\Http\Controllers\Shop\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Shop\BaseController as BaseController;
use App\Repositories\UserRepository;
use Auth;
use Validation;
use MetaTag;

class CheckoutController extends BaseController
{

    private $userRepository;

    public function __construct() {

        $this->userRepository = app(UserRepository::class);

    }

    public function index() {

        if(Auth::check() || \Session::get('email') || \Session::get('user_data')) {

            MetaTag::set('title', 'Доставка | Аметист');

            return view('shop.pages.checkout.index');

        }
        else {

            MetaTag::set('title', 'Вход | Аметист');

            return view('shop.pages.checkout.auth');

        }

    }

    public function checkMail(Request $request) {

        if($this->userRepository->ifExistsByEmail($request->email)) {

            return redirect()->back()->withErrors('Такая почта уже существует!');

        }
        else {

            if(Validation::validateEmail($request)) {

                \Session::put('email', $request->email);

                MetaTag::set('title', 'Заказ | Аметист');

                return redirect('/checkout');

            }
        }
    }

    public function setUserData(Request $request) {

        if(Validation::validateAddressForm($request)) {

            $user_data_arr = [
                'email' => $request->email,
                'name' => $request->name,
                'surename' => $request->surename,
                'phone' => $request->phone,
                'city' => $request->city,
                'address' => $request->address

            ];

            \Session::put('user_data', $user_data_arr);
            
            \Session::forget('email');

            return redirect('/checkout/payment');

        }

    }

    public function auth() {

        return view('shop.pages.checkout.auth');

    }

    public function payment() {

        MetaTag::set('title', 'Оплата');

        return view('shop.pages.checkout.payment');

    }



}
