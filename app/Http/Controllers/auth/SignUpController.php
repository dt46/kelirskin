<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Requests\SignUpRequest;
use App\Http\Controllers\Controller;
use App\Models\Reseller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class SignUpController extends Controller
{
    public function index()
    {
        return view('auth.sign-up');
    }

    // SignUpController.php
    public function signUp(SignUpRequest $request)
    {
        // Validasi input menggunakan SignUpRequest
        $validatedData = $request->validated();
    
        try {
            // Buat pengguna baru
            $user = new User();
            $user->role_id = Role::where('name', 'reseller')->first()->id;
            $user->name = explode('@', $validatedData['email'])[0];
            $user->email = $validatedData['email'];
            $user->password = Hash::make($validatedData['password']); // Hash the password
            $user->save();
    
            // Simpan foto KTP
            if ($request->hasFile('foto_ktp')) {
                $originalName = $request->file('foto_ktp')->getClientOriginalName();
                $path = $request->file('foto_ktp')->store('public/fotoKTP');
                $resellerFotoPath = str_replace('public', 'storage', $path);
            } else {
                throw new \Exception('File KTP tidak ditemukan.');
            }
    
            // Buat data reseller
            $reseller = new Reseller();
            $reseller->user_id = $user->id;
            $reseller->nama = $validatedData['nama'];
            $reseller->no_hp = $validatedData['no_hp'];
            $reseller->provinsi = $validatedData['provinsi'];
            $reseller->kota = $validatedData['kota'];
            $reseller->kecamatan = $validatedData['kecamatan'];
            $reseller->alamat_detail = $validatedData['alamat_detail'];
            $reseller->foto_ktp = $resellerFotoPath;
            $reseller->nama_file = $path; // Simpan jalur penyimpanan yang relatif
            $reseller->nama_file_original = $originalName;
            $reseller->save();
    
            // Log informasi sukses
            Log::info('Pendaftaran berhasil untuk pengguna: ' . $user->email);
    
            // Redirect dengan pesan sukses
            return redirect()->route('signin')->with('success', 'Pendaftaran berhasil!');
        } catch (\Exception $e) {
            // Log the exception
            Log::error('Pendaftaran gagal: ' . $e->getMessage());
    
            // Jika terjadi eksepsi, kembalikan dengan pesan kesalahan
            return back()->withInput()->withErrors(['error' => 'Pendaftaran gagal: ' . $e->getMessage()]);
        }
    }
    
}
