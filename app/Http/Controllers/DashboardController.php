<?php

namespace App\Http\Controllers;

use App\Http\Resources\TpiResource;
use App\Models\Arrival;
use App\Models\ArrivalManifest;
use App\Models\Deperature;
use App\Models\DeperatureManifest;
use App\Models\Reseller;
use App\Models\Tpi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
    
        // Filter berdasarkan kota atau kecamatan jika ada pencarian
        if ($searchTerm) {
            $resellers->where(function($query) use ($searchTerm) {
                $query->where('kota', 'LIKE', "%{$searchTerm}%")
                      ->orWhere('kecaamatan', 'LIKE', "%{$searchTerm}%");
            });
        }
    

        $resellers = $resellers->get(['lokasi_geojson']);

        // Mengubah data reseller menjadi GeoJSON
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