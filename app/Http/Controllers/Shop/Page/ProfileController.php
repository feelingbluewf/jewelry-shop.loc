<?php

namespace App\Http\Controllers\Shop\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Http\Controllers\Shop\BaseController as BaseController;
use MetaTag;
use Auth;
use Validation;
use Hash;

class ProfileController extends BaseController
{

  private $userRepository;

  public function __construct() {

    $this->userRepository = app(UserRepository::class);

  }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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

      $user = $this->userRepository->getOneUser($id);

      if($user) {

        $name = $user->name;

        MetaTag::set('title', "Профиль {$name} | Аметист");

        return view('shop.pages.profile.show',[
          'user' => $this->userRepository->getOneUser($id)
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

      if($request->type == 'change_password') {

        if(Validation::validatePassword($request)) {

          $new_user_password = Hash::make($request->new_password);

          if($this->userRepository->changePassword($id, $new_user_password)) {

            return redirect()->back()->withSuccess('Пароль успешно изменен');

          }
          else {

            return redirect()->back()->withErrors('Не удалось изменить пароль');

          }

        }

      }
      elseif($request->type == 'change_user_data') {

        if(Validation::validateUserData($request)) {

          if($updatedUser = $this->userRepository->changeUserData($id, $request)) {

            return redirect()->back()->withSuccess('Данные успешно изменены');

          }
          else {

            return redirect()->back()->withErrors('Не удалось изменить данные');

          }
        }

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
  }
