<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Helpers\CalcDistance;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Repositories\WashRequestRepository;
use App\Repositories\CaptainRequestRepository;
use App\Http\Requests\API\WashAPIRequest;
use App\Http\Requests\API\CaptainApproveRequest;
use App\Http\Requests\API\ChangeStatusAPIRequest;
use Kreait\Firebase\Contract\Database;
use App\Models\User;
use App\Models\WashRequest;

class WashRequestAPIController extends Controller
{
    private $database, $washRequestRepository, $captainRequestRepository;

    public function __construct(Database $database, WashRequestRepository $washRequest, CaptainRequestRepository $captainRequest)
    {
        $this->database = $database;
        $this->washRequestRepository = $washRequest;
        $this->captainRequestRepository = $captainRequest;
    }
    
    public function make_request(WashAPIRequest $request)
    {

        try {

            DB::beginTransaction();

            $washRequest = $this->washRequestRepository->create([
                            'client_id' => auth()->user()->id,
                            'location'  => $request->location,
                            'lat'       => $request->lat,
                            'lng'       => $request->lng
                        ]);

            $captains = User::AvailableCaptains()->get();

            foreach($captains as $captain){
            
                $res = CalcDistance::calculate_trip_distance_time($request->lat, $request->lng, $captain->lat, $captain->lng);

                if($res['distance'] <= 5){
     
                    $postData = [
                        //'request_id'    => $washRequest->id,
                        //'captain_id'    => $captain->id,
                        'client_name'   => auth()->user()->f_name . ' ' . auth()->user()->l_name ,
                        'location'      => $washRequest->location,
                        'lat'           => $washRequest->lat,
                        'lng'           => $washRequest->lng,
                        'distance'      => $res['distance'] . ' km'
                    ];

                    //$this->database->getReference('captain_requests')->push($postData).set(2);
                    $this->database->getReference('captain_requests/'.$captain->id)->update([$washRequest->id => $postData]);

                }
            }
                
            DB::commit();

            return response()->withSuccess(__('api.success'), 200);


        } catch (\Throwable $th) {
           
            DB::rollBack();
    
            return response()->withError($th->getMessage(), $th->getCode());
        }
    }


    public function captain_approval($washrequest_id)
    {
        /*
        * before the captain approves any request, we should check if he already approved any request
        * if he approved any request, then he can't approve another request, if not he can approve
        * i get all childkeys from request_captains_approval table,
        * then i foreach on them and get all request captains and check if this captain in request captains or not
        */

        $captain = auth()->user();
        $snapShot = $this->database->getReference('request_captains_approval')->getSnapshot();
        $requests   = $snapShot->hasChildren() 
                        ? $this->database->getReference('request_captains_approval')->getChildKeys() 
                        : array();

        foreach($requests as $request){
            $captains = $this->database->getReference('request_captains_approval/'. $request)->getChildKeys();
            if(in_array($captain->id, $captains))
                return response()->withError('you cant approve two requests', 5002);
        }        

        $captainData = [
            //'request_id'    => $washrequest_id,
            'captain_id'    => $captain->id,
            'captain_image' => $captain->image_path,
            'captain_name'  => $captain->f_name . ' ' . $captain->l_name,
            'captain_phone' => $captain->phone,
            'car_plate_number' => '127|kjl', //$captain->car->plate_number
            'arrival_time' => '5m',
            'washing_count' => 20
        ];

        //$this->database->getReference('request_captains_approval')->push($captainData);
                            
        $this->database->getReference('request_captains_approval/'. $washrequest_id)->update([$captain->id=>$captainData]);

                    
        return response()->withSuccess(__('api.request_accepted'), 200);


    }

    public function captain_rejected($washrequest_id)
    {
        /*
        * remove the request from captain requests
        */

        $captain = auth()->user();
                
        $this->database->getReference('captain_requests/'. $captain->id . '/' . $washrequest_id)->remove();

        return response()->withSuccess(__('api.request_rejected'), 200);
    }
        
    public function client_approval($washrequest_id, $captain_id)
    {

        /*
        * => remove the request from captain requests table
        * steps:
        * 1.get all captains in captain_requests table '$this->database->getReference('captain_requests')->getChildKeys()'
        * 2.foreach on them, and check if the captain has this request if has, remove it '$this->database->getReference('captain_requests/'. $captain . '/' . $washrequest_id)->remove()'
        * => remove the request from request_captains_approval table too '$this->database->getReference('request_captains_approval/'. $washrequest_id)->remove()'
        * => update wash request, set captain id with the captain that the client approved him
        */
        $captains = $this->database->getReference('captain_requests')->getChildKeys();

        foreach ($captains as $key => $captain) {
                        
            $captain_requests = $this->database->getReference('captain_requests/'. $captain)->getChildKeys();

            if(in_array($washrequest_id, $captain_requests)){
                        
                $this->database->getReference('captain_requests/'. $captain . '/' . $washrequest_id)->remove();
            }

        }
                
        $this->database->getReference('request_captains_approval/'. $washrequest_id)->remove();

        //update wash request, set captain id with the captain that the client approved him

        //$this->washRequestRepository->update(['captain_id' => $captain_id], $washrequest_id);

        WashRequest::where('id', $washrequest_id)->update(['captain_id' => $captain_id]);

        $requestStatusData = [
            'captain_id'    => $captain_id,
            'status'        => 1
        ];

        // $this->database->getReference('request_status')->push($requestStatusData);
                
        $this->database->getReference('request_status')->update([$washrequest_id=>$requestStatusData]);
        
        return response()->withSuccess(__('api.request_accepted'), 200);

    }


    public function change_status(ChangeStatusAPIRequest $request, $washrequest_id)
    {
        $captain = auth()->user();

        $washRequest = $this->washRequestRepository->find($washrequest_id);
            
        $requestStatusData = [
            'request_status/'. $washrequest_id . '/status'   => intval($request->status)
        ];

                    
        if($request->has('images')){
            foreach($request->images as $image){

                $this->UploadAsset(['asset'=>$image, 'path_to_save'=>'assets/uploads/wash_requests'], $washRequest);

            }

        }
                
        $this->database->getReference()->update($requestStatusData);

                
        return response()->withSuccess(__('api.request_status_changed'), 200);

    }

}
