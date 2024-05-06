<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreResellerRequest;
use App\Http\Requests\UpdateResellerRequest;
use App\Http\Resources\ResellerResource;
use App\Models\Reseller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResellerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.index-reseller');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreResellerRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $reseller = Reseller::join('users', 'resellers.user_id', 'users.id')
                ->select('resellers.id as id', 'nama', 'email', 'no_hp', 'alamat_detail', 'status')->get();


            if ($request->has('search')) {
                $search = $request->input('search');
                $reseller->where('nama', 'LIKE', "%$search%")
                    ->orWhere('email', 'LIKE', "%$search%")
                    ->orWhere('no_hp', 'LIKE', "%$search%")
                    ->orWhere('alamat_detail', 'LIKE', "%$search%")
                    ->orWhere('status', 'LIKE', "%$search%");
            }

            return response()->json([
                'status' => true,
                'data' => ResellerResource::collection($reseller)
            ], 201);
        }
        return view('manajemen-reseller.data-reseller');
    }

    public function showPengajuan(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $reseller = Reseller::join('users', 'resellers.user_id', 'users.id')
                ->select('resellers.id as id', 'nama', 'email', 'no_hp', 'alamat_detail', 'status')->get();


            if ($request->has('search')) {
                $search = $request->input('search');
                $reseller->where('nama', 'LIKE', "%$search%")
                    ->orWhere('email', 'LIKE', "%$search%")
                    ->orWhere('no_hp', 'LIKE', "%$search%")
                    ->orWhere('alamat_detail', 'LIKE', "%$search%")
                    ->orWhere('status', 'LIKE', "%$search%");
            }

            return response()->json([
                'status' => true,
                'data' => ResellerResource::collection($reseller)
            ], 201);
        }
        return view('manajemen-reseller.pengajuan-reseller');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reseller $reseller)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateResellerRequest $request, Reseller $reseller)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reseller $reseller)
    {
        //
    }
}