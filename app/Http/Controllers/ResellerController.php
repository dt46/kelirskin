<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreResellerRequest;
use App\Http\Requests\UpdateResellerRequest;
use App\Http\Requests\UpdateResellerStatusRequest;
use App\Http\Resources\ResellerResource;
use App\Models\Reseller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResellerController extends Controller
{
    public function index()
    {
        return view('dashboard.index-reseller');
    }

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
            $reseller = Reseller::where('status', false)->get();

            return response()->json([
                'status' => true,
                'data' => ResellerResource::collection($reseller)
            ], 201);
        }
        return view('manajemen-reseller.pengajuan-reseller');
    }

    public function updateStatus(UpdateResellerStatusRequest $request, Reseller $reseller)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $request->validated();

            $reseller->status = $request->status;
            $reseller->save();
    
            return response()->json([
                'status' => true,
                'data' => new ResellerResource($reseller)
            ], 201);
        }
    
        return response()->json(['status' => false], 401);
    }

    public function showResellerId(Reseller $reseller, Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'status' => 'true',
                'data' => new ResellerResource($reseller)
            ], 201);
        }

        return response()->json(['status' => false,], 401);
    }

    public function update(UpdateResellerRequest $request, Reseller $reseller)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $request->validated();
    
            $reseller->no_hp = $request->no_hp;
            $reseller->alamat_detail = $request->alamat_detail;
            $reseller->status = $request->status;
    
            $reseller->save();
    
            return response()->json([
                'status' => true,
                'data' => new ResellerResource($reseller)
            ], 201);
        }
    
        return response()->json(['status' => false], 401);
    }

    public function destroy(Reseller $reseller)
    {
        //
    }
}