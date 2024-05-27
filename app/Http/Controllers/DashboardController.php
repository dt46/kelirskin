<?php

namespace App\Http\Controllers;

use App\Models\Reseller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index');
    }

    public function showIndexLocationReseller(Request $request)
    {
        $searchTerm = $request->input('search');
        $resellers = Reseller::query();
    
        if ($searchTerm) {
            $resellers->where(function($query) use ($searchTerm) {
                $query->where('kota', 'LIKE', "%{$searchTerm}%")
                      ->orWhere('kecaamatan', 'LIKE', "%{$searchTerm}%");
            });
        }

        $resellers = $resellers->get(['lokasi_geojson']);

        $geojson = [
            'type' => 'FeatureCollection',
            'features' => []
        ];

        foreach ($resellers as $reseller) {
            $geojson['features'][] = json_decode($reseller->lokasi_geojson);
        }

        return view('map.location', [
            'geojson' => json_encode($geojson)
        ]);
    }
}