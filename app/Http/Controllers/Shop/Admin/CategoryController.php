<?php

namespace App\Http\Controllers\Shop\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\CategoryRepository;
use App\Repositories\OrderRepository;
use App\Repositories\ProductRepository;
use MetaTag;

class CategoryController extends AdminBaseController
{

    private $categoryRepository;
    private $orderRepository;
    private $productRepository;

    public function __construct() {

        parent::__construct();

        $this->categoryRepository = app(CategoryRepository::class);
        $this->orderRepository = app(OrderRepository::class);
        $this->productRepository = app(ProductRepository::class);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        MetaTag::set('title', 'Категории');

        $perPage = 12;

        return view('shop.admin.categories.index', [
            'countNewOrders' => $this->orderRepository->getCountNewOrders(),
            'categories' => $this->categoryRepository->getAllCategoriesPaginate($perPage),
            'countCategories' => $this->categoryRepository->getCountCategories()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        MetaTag::set('title', 'Добавление категории');

        return view('shop.admin.categories.create', [
            'countNewOrders' => $this->orderRepository->getCountNewOrders()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $createdCategory = $this->categoryRepository->createCategory($request->title);

       if($createdCategory) {

            return redirect()->back()->withSuccess("Категория '{$request->title}' успешно создана!");

        }
        else {

            return back()->withErrors(['msg' => 'Ошибка создания']);

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

        MetaTag::set('title', "Категория № {$id}");

        return view('shop.admin.categories.edit', [
            'countNewOrders' => $this->orderRepository->getCountNewOrders(),
            'category' => $this->categoryRepository->getOneCategory($id)
        ]);

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

     if($this->categoryRepository->changeTitle($id, $request->categoryTitle)){

        return redirect()->back()->withSuccess("Название категории № {$id} успешно изменено!");

     }
     else {
        return redirect()->back()->withErrors("Не удалось изменить название категории!");
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

    public function delete($id, $title) {

        if($this->categoryRepository->deleteCategory($id) && $this->productRepository->removeCategory($id)) {

            return redirect()->back()->withSuccess("Категория '{$title}' успешно удалена!");

        }
        else {

            return redirect()->back()->withErrors("Не удалось удалить категорию '{$title}'!");

        }

    }
}
