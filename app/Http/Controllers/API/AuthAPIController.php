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
use App\Http\Requests\API\LoginAPIRequest;
use App\Http\Requests\API\SocialAPIRequest;
use App\Http\Requests\API\ForgetPasswordAPIRequest;
use App\Http\Requests\API\CodeCheckAPIRequest;
use App\Http\Requests\API\ResetPasswordAPIRequest;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuthExceptions\JWTException;
use Tymon\JWTAuth\Contracts\JWTSubject as JWTSubject;
use App\Mail\SendVerificationCode;
use Illuminate\Support\Facades\Mail;

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
                'fcm'       => $request->fcm,
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

            return response()->withData(__('api.register_successfully'), $data);


        } catch (\Throwable $th) {
           
            DB::rollBack();
    
            return response()->withError($th->getMessage(), $th->getCode());
        }
        
    }

    public function login(LoginAPIRequest $request)
    {

        $credentail = [
            'email' => $request->email,
            'password' => $request->password
        ];
                    
        if(!$token = JWTAuth ::attempt( $credentail ) ){
            return response()->withError(__('api.wrong_password'), 5003, 'password');
        }

        $user = $this->userRepository->findBy('email', $request->email);

        $user->fcm = $request->fcm ?? $user->fcm;
        $user->save();

        $data = [
            'user'  => new UserResource($user),
            'token' => $token
        ];
            
        return response()->withData(__('api.login_successfully'), $data);
        
    }

    public function social_login(SocialAPIRequest $request)
    {
         
        $user = $this->userRepository->findBy('email', $request->email);

        if($user){
                        
            $token  = JWTAuth ::fromUser( $user );

            $data = [
                'user'  => new UserResource($user),
                'token' => $token
            ];
        
            return response()->withData(__('api.login_successfully'), $data);

        }else{

                            
            $user =  $this->userRepository->create([
                'f_name'    => $request->f_name ?? 'new',
                'l_name'    => $request->l_name ?? 'user',
                'email'     => $request->email,
                'password'  => Hash ::make( '123456' ),
                'city_id'   => \App\Models\City::first()->id, //default city
                'account_type' => 'client'
            ]);

            $user->attachRoles(['client']);

            if($request->has('image_url')){

                $user->asset()->create([
                    'name'          => 'user-socail-image' ,
                    'old_name'      => 'user-socail-image',
                    'size'          => '1111',
                    'url'           => $request->image_url,
                    'mime_type'     => 'image'
                ]);
            }

            $token  = JWTAuth ::fromUser( $user );
        
            $user = $this->userRepository->find($user->id);

            $data = [

                'user'  => new UserResource($user),
                'token' => $token

            ];
                            
            return response()->withData(__('api.register_successfully'), $data);

        }
    
    }

        
    public function forget_password(ForgetPasswordAPIRequest $request)
    {
                
        $user = $this->userRepository->findBy('email', $request->email);

        $code = generate_code();
        $user->code = $code;
        $user->save();

        try{      
            //send mail
            Mail::to($user->email)->send(new SendVerificationCode($user));

            $data = [
                'code' => $code
            ];

            return response()->withSuccess(__('api.code_send'), 200, $data);
        
        }  catch (\Throwable $th) {

            return response()->withError($th->getMessage(), $th->getCode());
        }


    }

    public function code_check(CodeCheckAPIRequest $request)
    {      

        $user = $this->userRepository->findBy('email', $request->email);

        if($user->code !== $request->code)
            return response()->withError(__('api.wrong_code'), 5003, 'code');

        return response()->withSuccess(__('api.success'), 200);

    }
            
    public function reset_password(ResetPasswordAPIRequest $request)
    {
                 
        $user = $this->userRepository->findBy('email', $request->email);

        $user->password = bcrypt($request->password);
        $user->code = null;
        $user->save();
                    
        return response()->withSuccess(__('api.password_changed_successfully'), 200);

    }
    public function logout()
    {        
        auth('api')->logout();  
        return response()->withSuccess(__('api.logout_successfully'), 200);

    }
}
