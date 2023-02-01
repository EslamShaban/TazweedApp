<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Repositories\ProductRepository;
use App\Http\Requests\Admin\ProductRequest;
use App\Models\Product;
use App\Models\Category;
use App\Models\CarType;
use App\Models\CarModel;

class ProductController extends Controller
{

    private $productRepository;
    
    public function __construct(ProductRepository $product)
    {
        $this->middleware('permission:products-read')->only(['index']);
        $this->middleware('permission:products-create')->only(['create', 'store']);
        $this->middleware('permission:products-update')->only(['edit', 'update']);
        $this->middleware('permission:products-delete')->only(['destroy']);

        $this->productRepository = $product;

    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->productRepository->all();

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $car_types = CarType::all();
        $car_models = CarModel::all();
        return view('admin.products.create', compact('categories', 'car_types', 'car_models'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request, Product $product)
    {
        try {

            DB::beginTransaction();
            
            $data = $request->except('_token', '_method', 'image', 'car_model_ids');

            $product = $this->productRepository->create($data);

            if($request->has('image')){
                $this->UploadAsset(['asset'=>$request->image, 'path_to_save'=>'assets/uploads/products'], $product);
            }
            
            $product->car_models()->sync($request->car_model_ids);

            DB::commit();

            return redirect(aurl('products'))->with('success', 'تم إضافة الحقل بنجاح');

        } catch (\Throwable $th) {
           
            DB::rollBack();

            throw $th;

            return redirect(aurl('products'))->with('error', 'حدث خطأ ما');

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
        $product = $this->productRepository->find($id);
        $categories = Category::all();
        $car_types = CarType::all();
        $car_models = CarModel::all();

        return view('admin.products.edit', compact('product', 'categories', 'car_types', 'car_models'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
                
        try {

            DB::beginTransaction();

            $data = $request->except('_token', '_method', 'image', 'car_model_ids');

            $this->productRepository->update($data, $product->id);

            if($request->has('image')){

                $this->DeleteAsset($product);
                $this->UploadAsset(['asset'=>$request->image, 'path_to_save'=>'assets/uploads/products'], $product);
            }
        
            $product->car_models()->sync($request->car_model_ids);

            DB::commit();

            return redirect(aurl('products'))->with('success', 'تم تعديل الحقل بنجاح');

        } catch (\Throwable $th) {
           
            DB::rollBack();
    
            throw $th;
        
            return redirect(aurl('products'))->with('error', 'حدث خطأ ما');
        
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
                
        try {

            DB::beginTransaction();

            $this->DeleteAsset($product);
            $this->productRepository->delete($product->id);
            
            DB::commit();
            
            return redirect(aurl('products'))->with('success', 'تم حذف الحقل بنجاح');

        } catch (\Throwable $th) {
           
            DB::rollBack();
    
            throw $th;
                
            return redirect(aurl('products'))->with('error', 'حدث خطأ ما');
    
        }
    }
}
