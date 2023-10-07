<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use League\Csv\Reader;

class FireController extends Controller
{
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

    public function compareWithFires($yourLatitude= 19.40436,$yourLongitude = -155.28375)
    {
        $response = Http::get('https://firms.modaps.eosdis.nasa.gov/api/country/csv/bbf49ab91b9ed4eed057e704a803400d/VIIRS_SNPP_NRT/USA/1/2023-10-07;');
        $csvData = $response->body();


        $csv = Reader::createFromString($csvData);
        $csv->setHeaderOffset(0); // Assuming the CSV file has headers
        $fireData = $csv->getRecords();


        foreach ($fireData as $firePoint) {
            $fireLatitude = $firePoint['Latitude'];
            $fireLongitude = $firePoint['Longitude'];
            $distance = $this->calculateDistance($yourLatitude, $yourLongitude, $fireLatitude, $fireLongitude);

            // Set a threshold (e.g., 50 km) and consider fire points within this range
            if ($distance < 50) {
                echo "Fire detected at $fireLatitude, $fireLongitude. Distance: $distance km\n";
                return;
            }
        }
    }
}

