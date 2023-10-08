<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MapController extends Controller
{
    public function calculateBoundingBox($latitude, $longitude)
    {
        $earth_radius = 6371; // Radius of the Earth in kilometers

        $lat_rad = deg2rad($latitude);
        $lon_rad = deg2rad($longitude);

        $d = 50 / $earth_radius;

        $min_lat = rad2deg($lat_rad - $d);
        $max_lat = rad2deg($lat_rad + $d);
        $min_lon = rad2deg($lon_rad - $d / cos($lat_rad));
        $max_lon = rad2deg($lon_rad + $d / cos($lat_rad));

        return [
            'min_lat' => $min_lat,
            'min_lon' => $min_lon,
            'max_lat' => $max_lat,
            'max_lon' => $max_lon,
        ];
    }
}
