<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\StoreResellerRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\UpdateResellerRequest;
use App\Http\Requests\UpdateResellerStatusRequest;
use App\Http\Resources\ResellerResource;
use App\Models\Reseller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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

    public function showProfile(){
        return view('profile.profile');
    }

    public function showKataSandi(){
        return view('profile.change-password');
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            try {
                $request->validated();
                $reseller = auth()->user()->reseller;
                $fotoProdukPath = $reseller->foto_profil;
                $originalName = $reseller->nama_foto_original;
        
                if ($request->hasFile('foto_profil')) {
                    $file = $request->file('foto_profil');
                    $originalName = $file->getClientOriginalName();
    
                    if ($reseller->fotoProduk) {
                        $oldFilePath = str_replace('storage', 'public', $reseller->foto_profil);
                        if (Storage::exists($oldFilePath)) {
                            Storage::delete($oldFilePath);
                        }
                    }
                    $path = $file->store('public/profile_images');
                    $fotoProdukPath = str_replace('public', 'storage', $path);
                }
        
                $reseller->nama = $request->nama;
                $reseller->no_hp = $request->no_hp;
                $reseller->provinsi = $request->provinsi;
                $reseller->kota = $request->kota;
                $reseller->kecamatan = $request->kecamatan;
                $reseller->alamat_detail = $request->alamat_detail;
                
                if ($request->hasFile('foto_profil')) {
                    $reseller->foto_profil = $fotoProdukPath;
                    $reseller->nama_foto_original = $originalName;
                }
        
                $reseller->save();

                return response()->json(['message' => 'Data Berhasil Diperbaharui', 'status' => true], 200);
            } catch (\Exception $e) {
                return response()->json(['error' => 'Terjadi Kesalahan' . $e->getMessage(), 'status' => false], 500);
            }
        }
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            try {
                $request->validated();
                $user = auth()->user();
    
                $user->password = Hash::make($request->password);
                $user->save();
    
                return response()->json(['message' => 'Password Berhasil Diganti', 'status' => true], 200);
            } catch (\Exception $e) {
                return response()->json(['error' => 'Terjadi Kesalahan: ' . $e->getMessage(), 'status' => false], 500);
            }
        }
    }
    public function destroy(Reseller $reseller)
    {
        //
    }
}