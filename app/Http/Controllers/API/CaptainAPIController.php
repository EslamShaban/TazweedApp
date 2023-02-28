<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\API\UpdateLocationAPIRequest;
use Kreait\Firebase\Contract\Database;

class CaptainAPIController extends Controller
{
 
    private $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function update_location(UpdateLocationAPIRequest $request)
    {
        $captain = auth()->user();

        $captain_location = [
            'lat' => $request->lat,
            'lng' => $request->lng
        ];
                            
        $this->database->getReference('captains/'.$captain->id)->update($captain_location);

        return response()->withSuccess(__('api.location_update_successfully'), 200);

    }

    public function toggle_status()
    {
        $captain = auth()->user();
        
        $captain->status = ! $captain->status;

        $captain->save();

        $captain_status = [
            'captains/'. $captain->id . '/status'   => (int)$captain->status
        ];

        $this->database->getReference()->update($captain_status);

        return response()->withData(__('api.status_changed_successfully'), ['status' => (int)$captain->status]);
    }

}
