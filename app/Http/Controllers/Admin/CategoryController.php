<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Repositories\CategoryRepository;
use App\Http\Requests\Admin\CategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{

    private $categoryRepository;
    
    public function __construct(CategoryRepository $category)
    {
        $this->middleware('permission:categories-read')->only(['index']);
        $this->middleware('permission:categories-create')->only(['create', 'store']);
        $this->middleware('permission:categories-update')->only(['edit', 'update']);
        $this->middleware('permission:categories-delete')->only(['destroy']);

        $this->categoryRepository = $category;

    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->categoryRepository->all();

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request, Category $category)
    {
                
        try {

            DB::beginTransaction();
            
            $data = $request->except('_token', '_method', 'image');

            $category = $this->categoryRepository->create($data);

            if($request->has('image')){
                $this->UploadAsset(['asset'=>$request->image, 'path_to_save'=>'assets/uploads/categories'], $category);
            }
            
            DB::commit();

            return redirect(aurl('categories'))->with('success', 'تم إضافة الحقل بنجاح');

        } catch (\Throwable $th) {
           
            DB::rollBack();

            throw $th;

            return redirect(aurl('categories'))->with('error', 'حدث خطأ ما');

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
        $category = $this->categoryRepository->find($id);

        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Category $category)
    {
                
        try {

            DB::beginTransaction();

            $data = $request->except('_token', '_method', 'image');

            $this->categoryRepository->update($data, $category->id);

            if($request->has('image')){

                $this->DeleteAsset($category);
                $this->UploadAsset(['asset'=>$request->image, 'path_to_save'=>'assets/uploads/categories'], $category);
            }

            DB::commit();

            return redirect(aurl('categories'))->with('success', 'تم تعديل الحقل بنجاح');

        } catch (\Throwable $th) {
           
            DB::rollBack();
    
            throw $th;
        
            return redirect(aurl('categories'))->with('error', 'حدث خطأ ما');
        
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
                
        try {

            DB::beginTransaction();

            $this->DeleteAsset($category);
            $this->categoryRepository->delete($category->id);
            
            DB::commit();
            
            return redirect(aurl('categories'))->with('success', 'تم حذف الحقل بنجاح');

        } catch (\Throwable $th) {
           
            DB::rollBack();
    
            throw $th;
                
            return redirect(aurl('categories'))->with('error', 'حدث خطأ ما');
    
        }
    }
}
