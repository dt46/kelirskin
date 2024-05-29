<?php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Reseller;

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
}
