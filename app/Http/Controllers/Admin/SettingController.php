<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Repositories\SettingRepository;
use App\Http\Requests\Admin\SettingRequest;
use App\Models\Setting;
class SettingController extends Controller
{
    private $settingRepository;
    
    public function __construct(SettingRepository $setting)
    {
        $this->middleware('permission:settings-read')->only(['index']);
        $this->middleware('permission:settings-update')->only(['update']);

        $this->settingRepository = $setting;

    }

    public function index()
    {
        $settings = $this->settingRepository->firstOrCreate();

        return view('admin.settings.index', compact('settings'));
    }

    public function update(SettingRequest $request)
    {

        try {

            DB::beginTransaction();

            $data = $request->except('_token', '_method', 'app_logo');

            if($request->has('app_logo')){

                $this->DeleteAsset(\App\Models\Setting::first());
                $this->UploadAsset(['asset'=>$request->app_logo, 'path_to_save'=>'assets/uploads/settings'], \App\Models\Setting::first());
            }

            $this->settingRepository->update($data, \App\Models\Setting::first()->id);
    
            DB::commit();

            return redirect(aurl('settings'))->with('success', 'تم تعديل الحقل بنجاح');

        } catch (\Throwable $th) {
           
            DB::rollBack();
    
            throw $th;
    
            return redirect(aurl('settings'));
    
        
        }

    }
}
