<?php

namespace App\Http\Helpers;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class CalcDistance
{

    public static function calculate_trip_distance_time($from_lat, $from_lng, $to_lat, $to_lng)
    {
        $ch = curl_init();  
        $url =  "https://maps.googleapis.com/maps/api/distancematrix/json";
        $dataArray = ['units'=>"km", 
        'origins'=>$from_lat . "," . $from_lng,
        'destinations'=>$to_lat . "," . $to_lng,
        'departure_time=now',
        'key'=>'AIzaSyB-uADMlF6PqwccIr3q6Vpyl0wJgJNsxOM'];
        $data = http_build_query($dataArray);
        $getUrl = $url."?".$data;
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_URL, $getUrl);
        curl_setopt($ch, CURLOPT_TIMEOUT, 80);
        $response = curl_exec($ch);
        //$vehicle = Vehicle::find($vehicle);
        $map = json_decode($response);
        $origin_address = $map->origin_addresses[0];
        $destination_addresses = $map->destination_addresses[0];
        if (isset($map->rows[0]->elements[0]->distance))
        {
            $km = round(($map->rows[0]->elements[0]->distance->value / 1000));
            $duration = ceil($map->rows[0]->elements[0]->duration->value / 60) * 60;
        }
        else {
            $km = 0;
            $duration = 0; 
        }
        // dd($response);
        // $vehicles = fractal($vehicles, new VehiclesTransformer(['km' => $km]));
        $data = array();
        $data['origin_address'] = $origin_address;
        $data['destination_addresses'] = $destination_addresses;
        $data['distance'] = ceil($km);
        $data['duration'] = $duration;
        //$data['price'] = ceil($vehicle->base_fare + ($data['distance'] * $vehicle->per_kilometer_fare));
        return $data;
    }
}
