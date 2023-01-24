<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Repositories\UserRepository;
use App\Http\Resources\UserResource;
use App\Http\Requests\API\RegisterAPIRequest;
use App\Http\Requests\API\LoginRequest;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuthExceptions\JWTException;
use Tymon\JWTAuth\Contracts\JWTSubject as JWTSubject;

class AuthAPIController extends Controller
{

    private $userRepository;
    
    public function __construct(UserRepository $user)
    {
        
        $this->userRepository = $user;

    }

    public function register(RegisterAPIRequest $request)
    {
        
        try {

            DB::beginTransaction();

            $user =  $this->userRepository->create([
                'f_name'    => $request->f_name,
                'l_name'    => $request->l_name,
                'email'     => $request->email,
                'password'  => bcrypt($request->password),
                'city_id'   => $request->city_id,
                'account_type' => 'client'
            ]);

            $user->attachRoles(['client']);

            if($request->has('image') && $request->image != null){

                $this->UploadAsset(['asset'=>$request->image, 'path_to_save'=>'assets/uploads/users'], $user);
            }

            $token  = JWTAuth ::fromUser( $user );
            $user = $this->userRepository->find($user->id);

            $data = [
                'user'  => new UserResource($user),
                'token' => $token
            ];
            
            DB::commit();

            return response()->withData('تم تسجيل بنجاح', $data);


        } catch (\Throwable $th) {
           
            DB::rollBack();
    
            return response()->withError($th->getMessage(), $th->getCode());
        }
        
    }

    public function set_user_city_and_branch(UpdateUserCityAndBranch $request)
    {
        
        try{

            $user = $this->UserRepository->find($request->user_id);

            if($user){

                $data = [
                    'city_id'       => $request->city_id,
                    'branch_id'     => $request->branch_id
                ];

                $this->UserRepository->update($data, $user->id);
                

                return response()->withSuccess(__('api.success'), 200);

            }else{

                            
                return response()->withError(__('api.user_not_exist'), 5004);

            }
        }catch (\Throwable $th) {
           
            DB::rollBack();
    
            return response()->withError($th->getMessage(), $th->getCode());
        }


    }

    public function login(LoginRequest $request)
    {

        $credentail = [
            'email' => $request->email,
            'password' => $request->password
        ];

        $user = $this->UserRepository->findBy('email', $request->email);

        if($user){      
                    
            if(!$token = JWTAuth ::attempt( $credentail ) ){
                return response()->withError(__('api.wrong_password'), 5003);
            }

        }else{

            return response()->withError(__('api.wrong_email'), 5004);
        }

        
        $data = [

            'user'  => [new UserResource($user)],
            'token' => $token
            
        ];

            
        return response()->withData(__('api.login_successfuly'), $data);

        
    }

  
        
    public function logout()
    {        
        auth('api')->logout();
                    
        return response()->withSuccess(__('api.logout_successfully'), 200);

    }
}
