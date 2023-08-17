<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Repositories\OfferRepository;
use App\Http\Requests\Admin\OfferRequest;
use App\Models\Category;
use App\Models\Offer;
use App\Models\OfferDetails;
use App\Models\Product;

class OfferController extends Controller
{

    private $offerRepository;

    public function __construct(OfferRepository $offer)
    {
        // $this->middleware('permission:offers-read')->only(['index']);
        // $this->middleware('permission:offers-create')->only(['create', 'store']);
        // $this->middleware('permission:offers-update')->only(['edit', 'update']);
        // $this->middleware('permission:offers-delete')->only(['destroy']);

        $this->offerRepository = $offer;

    }

    public function getAllProducts()
    {
        $products = Product::get();
        return response()->json([
           "products"=>$products,
        ]);
    }

    public function getAllCategories()
    {
        $categories = Category::get();
        return response()->json([
           "categories"=>$categories,
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offers = $this->offerRepository->all();

        return view('admin.offers.index', compact('offers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.offers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OfferRequest $request, Offer $offer)
    {

        try {

            DB::beginTransaction();

            $data = $request->except('_token', '_method', 'model_type', 'model_id');

            $offer = $this->offerRepository->create($data);

            if(isset($request->model_id)){
                foreach($request->model_id as $model_id){
                    OfferDetails::create([
                        'offer_id'  => $offer->id,
                        'model_id'  => $model_id,
                        'model_type'  => $request->model_type == 'product'  ? 'App\Models\Product' : 'App\Models\Category',
                    ]);
                }
            }

            DB::commit();

            return redirect(aurl('offers'))->with('success', 'تم إضافة الحقل بنجاح');

        } catch (\Throwable $th) {

            DB::rollBack();

            throw $th;

            return redirect(aurl('offers'))->with('error', 'حدث خطأ ما');

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
        $offer = $this->offerRepository->find($id);
        $firstChild = $offer->offerDetails->first();
        // dd($firstChild);
        $modelsIds = $offer->offerDetails->pluck('model_id')->toArray();

        $models = $firstChild->model_type == 'App\Models\Category' ? Category::all()  : Product::all();
        $model_type = $firstChild->model_type == 'App\Models\Category' ? 'category'  : 'product';

        return view('admin.offers.edit', compact('offer', 'models', 'model_type', 'modelsIds'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OfferRequest $request, Offer $offer)
    {

        try {

            DB::beginTransaction();

            $data = $request->except('_token', '_method', 'model_type', 'model_id');

            $this->offerRepository->update($data, $offer->id);

            if(isset($request->model_id)){
                $offer->offerDetails()->delete();
                foreach($request->model_id as $model_id){
                    OfferDetails::create([
                        'offer_id'  => $offer->id,
                        'model_id'  => $model_id,
                        'model_type'  => $request->model_type == 'product'  ? 'App\Models\Product' : 'App\Models\Category',
                    ]);
                }
            }

            DB::commit();

            return redirect(aurl('offers'))->with('success', 'تم تعديل الحقل بنجاح');

        } catch (\Throwable $th) {

            DB::rollBack();

            throw $th;

            return redirect(aurl('offers'))->with('error', 'حدث خطأ ما');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Offer $offer)
    {

        try {

            DB::beginTransaction();

            $this->offerRepository->delete($offer->id);

            DB::commit();

            return redirect(aurl('offers'))->with('success', 'تم حذف الحقل بنجاح');

        } catch (\Throwable $th) {

            DB::rollBack();

            throw $th;

            return redirect(aurl('offers'))->with('error', 'حدث خطأ ما');

        }
    }
}
