<?php

namespace App\Http\Controllers\Shop\Page;

use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use MetaTag;

use App\Http\Controllers\Shop\BaseController as BaseController;

class ShopController extends BaseController
{

    private $categoryRepository;
    private $productRepository;

    public function __construct() {

        $this->categoryRepository = app(CategoryRepository::class);
        $this->productRepository = app(ProductRepository::class);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        MetaTag::set('title', 'Магазин | Аметист');

        $perPage = 12;

        return view('shop.pages.shop.index', [
            'categories' => $this->categoryRepository->getAllCategories()
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

        $product = $this->productRepository->getOneProduct($id);

        if($product) {

            MetaTag::set('title', "{$product->title} | Аметист");

            $count = 12;

            return view('shop.pages.shop.show', [
                'product' => $product,
                'otherProducts' => $this->productRepository->getRandomProducts($count, $product->id)
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
