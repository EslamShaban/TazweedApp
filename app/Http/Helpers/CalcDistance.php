<?php

namespace App\Http\Helpers;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class CalcDistance
{

    public static function get_nearest_captain($lat, $lng)
    {

        $captain = User::where('account_type', 'captain')
                        ->select(['id', 'f_name', 'l_name'])
                        ->addSelect(DB::raw("ST_Distance_Sphere(
                            POINT('$lng', '$lat'), POINT(lng, lat)
                        ) * 0.001 as distance"))
                        ->orderBy('distance')
                        ->take(1)
                        ->get();
        return $captain;

    }

    function haversineDistance($lat1, $lon1, $lat2, $lon2) { 

        // Convert the latitude and longitude values to radians 
        $lat1 = deg2rad($lat1); 
        $lon1 = deg2rad($lon1); 
        $lat2 = deg2rad($lat2); 
        $lon2 = deg2rad($lon2); 

        // Calculate the difference between the two points using the Haversine formula  
        $deltaLat = ($lat2 - $lat1);  
        $deltaLon = ($lon2 - $lon1);  

        // Calculate the great circle distance in kilometers  
        $distance = 2 * asin(sqrt(pow(sin($deltaLat/2), 2) + cos($lat1) * cos($lat2) * pow(sin($deltaLon/2), 2)));  

        return round($distance, 3); // Return distance in kilometers (3 decimal places) 
    }

    public function google_map()
    {    

        $origin = "48.8583701,2.2944813"; //latitude and longitude of origin location
        $destination = "48.856614,2.3522219"; //latitude and longitude of destination location 
               
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=$origin&destinations=$destination&key=AIzaSyDWZCkmkzES9K2-Ci3AhwEmoOdrth04zKs",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
        ));
        $response = curl_exec($curl); // Execute the request and store the response in a variable. 
        $err = curl_error($curl); // Check for errors. 
        if ($err) { echo "cURL Error #:" . $err; } 
        else { // Parse the response and extract the distance between locations. 
            $responseData = json_decode($response); 
            //$distance = $responseData->rows[0]->elements[0]->distance->text; 
            echo $response; 
        }
    }

    function distance($lat1, $lon1, $lat2, $lon2, $unit) {
        if (($lat1 == $lat2) && ($lon1 == $lon2)) {
            return 0;
        }
        else {
            $theta = $lon1 - $lon2;
            $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
            $dist = acos($dist);
            $dist = rad2deg($dist);
            $miles = $dist * 60 * 1.1515;
            $unit = strtoupper($unit);

            if ($unit == "K") {
            return ($miles * 1.609344);
            } else if ($unit == "N") {
            return ($miles * 0.8684);
            } else {
            return $miles;
            }
        }
    }
}
