<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Helpers\CalcDistance;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Repositories\WashRequestRepository;
use App\Repositories\CaptainRequestRepository;
use App\Http\Requests\API\WashRequest;
use App\Http\Requests\API\CaptainApproveRequest;
use Kreait\Firebase\Contract\Database;

class WashRequestAPIController extends Controller
{
    private $database, $washRequestRepository, $captainRequestRepository;

    public function __construct(Database $database, WashRequestRepository $washRequest, CaptainRequestRepository $captainRequest)
    {
        $this->database = $database;
        $this->washRequestRepository = $washRequest;
        $this->captainRequestRepository = $captainRequest;
    }
    
    public function make_request(WashRequest $request)
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
                    $this->captainRequestRepository->create([
                            'captain_id'        => $captain->id,
                            'wash_request_id'   => $washRequest->id,
                            'arrival_time'      => $res['duration']/60
                        ]);

                                
                    $postData = [
                        'request_id' => $washRequest->id,
                        'captain_id' => $captain->id,
                        'client_name' => auth()->user()->f_name . ' ' . auth()->user()->l_name ,
                        'location' => $washRequest->location,
                        'distance' => $res['distance'] . ' km'
                    ];

                    $this->database->getReference('request_captains')->push($postData);
                }
            }


                
            DB::commit();

            return response()->withSuccess('تم إرسال الطلب لاقرب كابتن', 200);


        } catch (\Throwable $th) {
           
            DB::rollBack();
    
            return response()->withError($th->getMessage(), $th->getCode());
        }
    }


    public function captain_approval(CaptainApproveRequest $request)
    {
        $captain = auth()->user();

        $captainData = [
            'request_id'    => $request->request_id,
            'captain_id'    => $captain->id,
            'captain_image' => $captain->image_path,
            'captain_name'  => $captain->f_name . ' ' . $captain->l_name,
            'captain_phone' => $captain->phone,
            'car_plate_number' => '127|kjl', //$captain->car->plate_number
            'arrival_time' => '5m',
            'washing_count' => 20
        ];

        $this->database->getReference('request_captains_approval')->push($captainData);
    }

}
