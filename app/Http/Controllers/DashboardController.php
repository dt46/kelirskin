<?php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Reseller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'countReseller' => Reseller::count(),
            'countOrder' => Order::count(),
            'totalHarga' => Order::sum('total_harga'),
        ];

        $profitsPerMonth = Order::selectRaw('EXTRACT(MONTH FROM created_at) as month, SUM(total_harga) as total_profit')
            ->groupByRaw('EXTRACT(MONTH FROM created_at)')
            ->pluck('total_profit', 'month')
            ->toArray();

        $monthlyProfits = array_fill(1, 12, 0);

        foreach ($profitsPerMonth as $month => $profit) {
            $monthlyProfits[$month] = $profit;
        }

        $data['monthlyProfits'] = $monthlyProfits;

        return view('dashboard.index', $data);
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
