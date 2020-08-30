<?php

namespace App\Http\Controllers\Shop\Admin;

use App\Repositories\OrderRepository;
use App\Repositories\ProductRepository;
use App\Repositories\CategoryRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use MetaTag;
use Img;

class ProductController extends AdminBaseController
{

	private $orderRepository;
	private $productRepository;
    private $categoryRepository;

    public function __construct() {

      parent::__construct();

      $this->orderRepository = app(OrderRepository::class);

      $this->productRepository = app(ProductRepository::class);

      $this->categoryRepository = app(CategoryRepository::class);

  }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    	MetaTag::set('title', 'Список товаров');

        $perPage = 12;

        return view('shop.admin.products.index', [
          'countNewOrders' => $this->orderRepository->getCountNewOrders(),
          'countProducts' => $this->productRepository->getCountProducts(),
          'products' => $this->productRepository->getAllProducts($perPage)
      ]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        MetaTag::set('title', 'Добавление нового товара');

        return view('shop.admin.products.create', [
            'countNewOrders' => $this->orderRepository->getCountNewOrders(),
            'categories' => $this->categoryRepository->getAllCategories()
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

       $createdProduct = $this->productRepository->createProduct($request);

       if($createdProduct) {

        $this->productRepository->saveGallery($createdProduct->id);

        return redirect()->back()->withSuccess("Товар '{$createdProduct->title}' успешно сохранен!");

    }
    else {

        return back()->withErrors(['msg' => 'Ошибка сохранения']);

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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        MetaTag::set('title', "Pедактирование товара № {$id}");

        return view('shop.admin.products.edit', [
            'countNewOrders' => $this->orderRepository->getCountNewOrders(),
            'categories' => $this->categoryRepository->getAllCategories(),
            'product' => $this->productRepository->getOneProduct($id)
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {

        $updatedProduct = $this->productRepository->updateProduct($id, $request);

        if($updatedProduct) {

         $this->productRepository->updateGallery($updatedProduct->id);

         return redirect()->back()->withSuccess("Товар '{$updatedProduct->title}' успешно обновен!");

     }
     else {

         return back()->withErrors(['msg' => 'Ошибка обновления']);

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

    /** Ajax upload main image*/

    public function uploadImage(Request $request) {

        $validator = \Validator::make($request->all(),
         [
            'file' => 'image|max:5000'
        ],
        [
            'file.image' => 'Файл должен быть картинкой (jpeg, jpg, png, gif, svg)',
            'file.max' => 'Ошибка! Максимальный размер картинки - 5 МБ!'
        ]);

        if($validator->fails()) {

            return array(
                'error' => 'error',
                'message' => $validator->errors()->first('file')
            );

        }

        $directory = 'uploads/' . $request->type . '/';
        $file = $request->file('file');
        $original_file_name = uniqid() . '_'. time() . $file->getClientOriginalName();
        $width = 500;
        $height = 500;

        $store = Img::store($original_file_name, $directory, $file, $request->type, $width, $height);

        if($store) {

            if($request->type == 'main') {

                return array(
                    'filename' => $original_file_name,
                    'type' => $request->type,
                    'session' => \Session::get($request->type)
                );

            }
            else {

                return array(
                    'filename' => $original_file_name,
                    'type' => $request->type,
                    'session' => \Session::get($request->type),
                    'key' => array_key_last(\Session::get($request->type))
                );

            }
        }
        else {

            return redirect()->back()->with('error', 'Не удалось загрузить картинку!');

        }

    }

    public function deleteImage($type, $filename, $key) {

        \File::delete('uploads/' . $type . '/' . $filename);

        if($type == 'gallery'){

            $imgArr = \Session::get($type);
            unset($imgArr[$key]);

            \Session::forget($type);
            \Session::put($type, $imgArr);

        }
        if($type == 'deleted_img'){

            \Session::push($type, $key);

        }
        if($type == 'main') {

            \Session::forget($type);

        }
    }

    public function toggleOn($id) {

        if($this->productRepository->enableProduct($id)) {

            return redirect()->back()->withSuccess("Товар № {$id} включен!");

        }
        else {

            return redirect()->back()->withErrors("Не удалось включить товар № {$id}!");

        }

    }

    public function toggleOff($id) {

        if($this->productRepository->disableProduct($id)) {

            return redirect()->back()->withSuccess("Товар № {$id} выключен!"); 

        }
        else {

            return redirect()->back()->withSuccess("Не удалось выключить Товар № {$id}"); 

        }     

    }

    public function delete($id, $title) {

        if($this->productRepository->deleteProduct($id)) {

            return redirect()->back()->withSuccess("Товар '{$title}' удален!"); 

        }
        else {

            return redirect()->back()->withSuccess("Не удалось удалить товар '{$title}'!"); 

        }
    }

}
