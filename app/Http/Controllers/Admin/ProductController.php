<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Repositories\ProductRepository;
use App\Http\Requests\Admin\ProductRequest;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Product;
use App\Models\Category;
use App\Models\CarType;
use App\Models\CarModel;
use App\Models\ProductVariant;

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

            // return redirect(aurl('products'))->with('success', 'تم إضافة الحقل بنجاح');

            return redirect(route('admin.product_attributes').'?product_id='.$product->id);
        } catch (\Throwable $th) {

            DB::rollBack();

            throw $th;

            return redirect(aurl('products'))->with('error', 'حدث خطأ ما');

        }
    }

    public static function build($set)
    {
        if (!$set) {
            return array(array());
        }

        $subset = array_shift($set);
        $cartesianSubset = self::build($set);

        $result = array();
        // dd($subset);
        foreach ($subset as $value) {
            foreach ($cartesianSubset as $p) {
                array_unshift($p, $value);
                $result[] = $p;
            }
        }

        return $result;
    }

    public function products_attributes(){
        $product_id = request()->product_id ;
        $attributes = Attribute::with('attributevalue')->get();
        return view('admin.products.product_attributes',compact('attributes','product_id'));
    }

    public function store_product_attributes(Request $request){

        $product_data = Product::where('id' , request()->product_id)->first();
        if(isset(request()->super_attributes)){
            echo "<pre>";
            $product  = $this->build(request()->super_attributes);
            $var_names = "";
            foreach($product as $i => $tuple){
                $vars =  implode('-', $tuple);
                // dd($tuple);
                $var_array = str_replace('-', ',', $vars);
                $variants = explode(',', $var_array);
                $product_var = $product_data->sku."-product-".implode('-', $tuple);
                $check_inserted_before = ProductVariant::where('sku',$product_var)->count();
                if($check_inserted_before  > 0){
                    continue ;
                }
                foreach($tuple as $tuple_name){
                    $attr_name = AttributeValue::where('id' , $tuple_name)->first();
                    $var_names.= "  ".$attr_name->name ;
                }
                // dd($var_names);
                $product_variant = new ProductVariant();
                $product_variant->sku = $product_var ;
                $product_variant->name = $var_names ;
                $product_variant->product_id = request()->product_id ;
                $product_variant->variants = json_encode( $variants  ) ;
                $product_variant->save();
                $var_names = "";
            }
            $attr = array();
            foreach($variants as $attr_id){
                $attr_val = AttributeValue::where('id' , $attr_id)->first();
                array_push($attr ,$attr_val->attribute_id );
            }
            Product::where('id' , request()->product_id)
            ->update([
                'attribute_id' =>json_encode( $attr  )
            ]);

        }
            return redirect()->route("admin.product_variants",['id'=>request()->product_id]);
    }

    public function product_variants($id){
        $product_data = ProductVariant::where('product_id',$id)->get();
        $main_product_data = Product::where('id',$id)->first();

       return view('admin.products.product_variants',compact('product_data','id','main_product_data'));

    }

    public function store_product_variants(Request $request){
        // dd(request()->its_id);
        if(isset(request()->quantity)){
            $count =count(request()->quantity);
            $total_amount = 0 ;
            for($i=0;$i<$count;$i++){
            if(isset($request->image[$i])){
                    $img = 'product-' . uniqid() . '.' . $request->image[$i]->getClientOriginalExtension();
                    $request->image[$i]->move('../storage/app/public/images/product', $img);

                    ProductVariant::where('sku', request()->sku[$i])
                    ->update([
                        'quantity' =>$request->quantity[$i] ,
                        'price' =>$request->price[$i] ,
                        'image' =>$img
                    ]);
                }else{
                    ProductVariant::where('sku', request()->sku[$i])
                    ->update([
                        'quantity' =>$request->quantity[$i] ,
                        'price' =>$request->price[$i]
                    ]);

                }

                $total_amount += $request->quantity[$i] ;

            }

            $product_id = ProductVariant::where('sku',request()->sku[0])->first();
            $id = $product_id ->product_id ;

            Product::where('id',$id)
            ->update([
                'quantity' => $total_amount ,
            ]);

        }else{
            $id = request()->its_id;
            $product_quantity = request()->product_quantity;

            Product::where('id',$id)
            ->update([
                'quantity' =>$product_quantity ,
            ]);
        }

        return redirect(aurl('products'))->with('success', 'تم تعديل الحقل بنجاح');
    }

    public function delete_product_variant($id){
        ProductVariant::where('id',$id)->delete();
         return redirect()->back();
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
