<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\API\WashRequest;
use App\Repositories\WashRequestRepository;
use App\Repositories\CaptainRequestRepository;
use App\Http\Helpers\CalcDistance;

class WashRequestAPIController extends Controller
{
    private $washRequestRepository, $captainRequestRepository;
    
    public function __construct(WashRequestRepository $washRequest, CaptainRequestRepository $captainRequest)
    {
        $this->washRequestRepository = $washRequest;
        $this->captainRequestRepository = $captainRequest;
    }
    
    public function make_request(WashRequest $request)
    {
                    $captain = CalcDistance::get_nearest_captain($request->lat, $request->lng);
            return response()->withSuccess('تم إرسال الطلب لاقرب كابتن', $captain);


        try {

            DB::beginTransaction();

            $washRequest = $this->washRequestRepository->create([
                            'client_id' => auth()->user()->id,
                            'location'  => $request->location,
                            'lat'       => $request->lat,
                            'lng'       => $request->lng
                        ]);

            // calculate the distance and get the nearest_captain

            $captain = CalcDistance::get_nearest_captain($request->lat, $request->lng);

            $this->captainRequestRepository->create([
                    'captain_id'        => $captain->id,
                    'wash_request_id'   => $request->location
                ]);
                
            DB::commit();

            return response()->withSuccess('تم إرسال الطلب لاقرب كابتن', 200);


        } catch (\Throwable $th) {
           
            DB::rollBack();
    
            return response()->withError($th->getMessage(), $th->getCode());
        }
    }

}
