<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Http\Requests\Admin\CaptainRequest;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Car;
use Kreait\Firebase\Contract\Database;

class CaptainController extends Controller
{
    private $database, $userRepository;
    
    public function __construct(Database $database, UserRepository $captain)
    {
        $this->middleware('permission:captains-read')->only(['index']);
        $this->middleware('permission:captains-create')->only(['create', 'store']);
        $this->middleware('permission:captains-update')->only(['edit', 'update']);
        $this->middleware('permission:captains-delete')->only(['destroy']);

        $this->userRepository = $captain;
        $this->database = $database;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $captains = $this->userRepository->getUserBaseRole(['captain']);
        
        return view('admin.captains.index', compact('captains'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.captains.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CaptainRequest $request)
    {
        try {

            DB::beginTransaction();
            
            $data = $request->except('_token', '_method');

            $data['password'] = bcrypt($request->password);
            $data['account_type'] = 'captain';

            //save captain
            $captain = $this->userRepository->create($data);

            $captain->attachRoles(['captain']);

            // save car data
            $car = new Car;
            $car->plate_number = $request->plate_number;
            $car->user_id = $captain->id;
            $car->save();

            //save image
            if($request->has('image')){

                $this->UploadAsset(['asset'=>$request->image, 'path_to_save'=>'assets/uploads/users'], $captain);
            }
            
            // add the captain to firebase collection

            $captain_data = [
                'lat' => $request->lat,
                'lng' => $request->lng,
                'available' => 1,
                'status' => 0
            ];
                            
            $this->database->getReference('captains/'.$captain->id)->update($captain_data);


            DB::commit();

            return redirect(aurl('captains'))->with('success', 'تم إضافة الحقل بنجاح');

    
        } catch (\Throwable $th) {
           
        DB::rollBack();

        throw $th;

        return redirect(aurl('captains'))->with('error', 'حدث خطأ ما');
    
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
        $captain = $this->userRepository->find($id);

        return view('admin.captains.edit', compact('captain'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CaptainRequest $request, User $captain)
    {
        try {

            DB::beginTransaction();

            $data = $request->except('_token', '_method','password');

            if(request()->has('password') && $request->password != null){
                $data['password'] = bcrypt($request->password);
            }

            $this->userRepository->update($data, $captain->id);

            // save car data
            $car = $captain->car;
            $car->plate_number = $request->plate_number;
            $car->save();

            if($request->has('image')){

                $this->DeleteAsset($captain);
                $this->UploadAsset(['asset'=>$request->image, 'path_to_save'=>'assets/uploads/users'], $captain);
            }

            DB::commit();

            return redirect(aurl('captains'))->with('success', 'تم تعديل الحقل بنجاح');

        } catch (\Throwable $th) {
           
            DB::rollBack();
    
            throw $th;
        
            return redirect(aurl('captains'))->with('error', 'حدث خطأ ما');
    
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $captain)
    {
        
        try {

            DB::beginTransaction();

            $this->DeleteAsset($captain);
            $this->userRepository->delete($captain->id);
            
            // remove the captain from firebase collection
            $this->database->getReference('captains/'. $captain->id)->remove();

            DB::commit();
            
            return redirect(aurl('captains'))->with('success', 'تم حذف الحقل بنجاح');

        } catch (\Throwable $th) {
           
            DB::rollBack();
    
            throw $th;

            return redirect(aurl('captains'))->with('error', 'حدث خطأ ما');
    
        
        }
    }
}
