<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use League\Csv\Reader;
use Illuminate\Support\Promise;

// function someAsyncOperation() {
//     return new Promise(function ($resolve, $reject) {
//         // Simulate an asynchronous operation (e.g., fetching data from an API)
//         $success = true; // Set to false to simulate an error

//         if ($success) {
//             $result = 'Async operation succeeded!';
//             $resolve($result);
//         } else {
//             $error = 'Async operation failed!';
//             $reject($error);
//         }
//     });
// }

// // Using the promise
// someAsyncOperation()->then(
//     function ($result) {
//         echo $result;
//     },
//     function ($error) {
//         echo $error;
//     }
// );
class FireController extends Controller
{





// Using the promise


    public function calculateDistance($lat1, $lon1, $lat2, $lon2)
    {
        $R = 6371; // Radius of the Earth in kilometers
        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);
        $a = sin($dLat/2) * sin($dLat/2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLon/2) * sin($dLon/2);
        $c = 2 * atan2(sqrt($a), sqrt(1-$a));
        $distance = $R * $c;
        return $distance;
    }

    public function compareWithFires()
    {
        $yourLatitude= 19.40436;$yourLongitude = -156.28375;
        $currentDate = date('Y-m-d');
        $url = "https://firms.modaps.eosdis.nasa.gov/api/country/csv/bbf49ab91b9ed4eed057e704a803400d/VIIRS_SNPP_NRT/USA/1/$currentDate";

        $response = Http::get($url);

        if ($response->successful()) {
            // The request was successful
            $csvData = $response->body();
            // Process $body here
        } else {
            // The request failed
            $status = $response->status();
            echo "error 404";
        }


// echo $csvData;

        $csv = Reader::createFromString($csvData);
        $csv->setHeaderOffset(0); // Assuming the CSV file has headers
        $fireData = $csv->getRecords();


        foreach ($fireData as $firePoint) {
            $fireLatitude = $firePoint['latitude'];
            $fireLongitude = $firePoint['longitude'];
            $distance = $this->calculateDistance($yourLatitude, $yourLongitude, $fireLatitude, $fireLongitude);
            echo $distance,"\n";
            // Set a threshold (e.g., 50 km) and consider fire points within this range
            if ($distance < 50) {
                echo "Fire detected at $fireLatitude, $fireLongitude. Distance: $distance km\n";
                return;
            }

        }
        echo "Safe hh";
    }
}

