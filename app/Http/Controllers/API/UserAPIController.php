<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Repositories\UserRepository;
use App\Http\Resources\UserResource;
use App\Repositories\CityRepository;
use App\Http\Resources\CityResource;
use App\Http\Requests\API\UpdateProfileAPIRequest;
use App\Http\Requests\API\ChangePasswordAPIRequest;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuthExceptions\JWTException;
use Tymon\JWTAuth\Contracts\JWTSubject as JWTSubject;

class UserAPIController extends Controller
{

    private $userRepository, $cityRepository;
    
    public function __construct(UserRepository $user, CityRepository $city)
    {
        $this->userRepository = $user;
        $this->cityRepository = $city;
    }

    public function my_profile()
    {
        $user = auth()->user();
        $cities = $this->cityRepository->all();

        $data = [
            'user'    => new UserResource($user),
            'cities'  => CityResource::collection($cities),   
        ];

        return response()->withData(__('api.profile_data'), $data);
    }

    public function update_profile(UpdateProfileAPIRequest $request)
    {
                
        try {

            DB::beginTransaction();

            $user   = auth()->user();

            $this->userRepository->update($request->all(), $user->id);
                        
            if($request->has('image')){

                $this->DeleteAsset($user);
                $this->UploadAsset(['asset'=>$request->image, 'path_to_save'=>'assets/uploads/users'], $user);
            }

            $user       = $this->userRepository->find($user->id);

            $token      = JWTAuth ::fromUser( $user );

            $data = [

                'user'  => new UserResource($user),
                'token' => $token

            ];
            
            DB::commit();

            return response()->withData(__('api.profile_updated_successfully'), $data);


        } catch (\Throwable $th) {
           
            DB::rollBack();
    
            return response()->withError($th->getMessage(), $th->getCode());
        }
    }

    public function change_password(ChangePasswordAPIRequest $request)
    {
        $user = auth()->user();

        if(! Hash::check($request->old_password, $user->password))
            return response()->withError(__('api.old_password_wrong'), 5003);

        $user->password = bcrypt($request->new_password);
        $user->save();

        return response()->withSuccess(__('api.password_changed_successfully'), 200);

    }
}
