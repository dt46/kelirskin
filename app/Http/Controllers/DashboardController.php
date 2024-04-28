<?php

namespace App\Http\Controllers;

use App\Http\Resources\TpiResource;
use App\Models\Arrival;
use App\Models\ArrivalManifest;
use App\Models\Deperature;
use App\Models\DeperatureManifest;
use App\Models\Tpi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index');
    }
}