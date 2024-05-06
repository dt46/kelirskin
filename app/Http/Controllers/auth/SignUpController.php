<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Requests\SignUpRequest;
use App\Http\Controllers\Controller;
use App\Models\Reseller;
use App\Models\Role;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

use function Laravel\Prompts\error;

class SignUpController extends Controller
{
    public function index()
    {
        return view('auth.sign-up');
    }

    public function signUp(SignUpRequest $request)
    {
        $req = $request->validated();
    
        DB::beginTransaction();
        try {
            $role = Role::where('name', 'reseller')->first();
            if (!$role) {
                throw new \Exception('Role reseller tidak ditemukan.');
            }
            info('Role ID: ' . $role->id);
    
            $user = new User();
            $user->role_id = $role->id; // Menggunakan nilai ID yang diambil dari database
            $user->name = explode('@', $req['email'])[0];
            $user->email = $req['email'];
            $user->password = Hash::make($req['password']); // Pastikan untuk menggunakan password dari request
            $user->save();
    
            $reseller = new Reseller;
            $reseller->user_id = $user->id;
            $reseller->nama = $req['nama'];
            $reseller->no_hp = $req['no_hp'];
            $reseller->provinsi = $req['provinsi'];
            $reseller->kota = $req['kota'];
            $reseller->kecamatan = $req['kecamatan'];
            $reseller->alamat_detail = $req['alamat_detail'];
            
            // Proses upload file foto_ktp
            if ($request->hasFile('foto_ktp')) {
                $file = $request->file('foto_ktp');
                $originalName = $file->getClientOriginalName();
                $path = $file->store('public/ktp_images');
                $reseller->foto_ktp = str_replace('public', 'storage', $path);
                $reseller->nama_file_original = $originalName; // Menyimpan nama file asli
            }
            
            $alamat_detail = $req['kota'];

            $client = new Client();
            // $response = $client->get('https://api.openweathermap.org/data/2.5/weather', [
            //     'query' => ['q' => $alamat_detail, 'APPID' => 'd0767a57f3f3e2868852fd0de169b817']
            // ]);
            $response = $client->get('https://api.openweathermap.org/data/2.5/weather', [
                'query' => ['q' => $alamat_detail, 'APPID' => 'd0767a57f3f3e2868852fd0de169b817']
            ]);
            $body = json_decode($response->getBody(), true);
            $coordinates = $body['coord'];

            // Membuat struktur GeoJSON
            $geoJSON = [
                'type' => 'Feature',
                'geometry' => [
                    'type' => 'Point',
                    'coordinates' => [$coordinates['lon'], $coordinates['lat']]
                ],
                'properties' => [
                    'alamat' => $req['alamat_detail'],
                    'provinsi' => $req['provinsi'],
                    'kota' => $req['kota'],
                    'kecamatan' => $req['kecamatan'],
                    // Tambahkan properti lain jika diperlukan
                ]
            ];
            
            // Simpan data GeoJSON sebagai string JSON
            $reseller->lokasi_geojson = json_encode($geoJSON);

            $reseller->save();
            
            DB::commit();
    
            return redirect()->route('signin')->with("res-status", [
                'msg' => "Pendaftaran berhasil. Silakan periksa email Anda.",
                'status' => 'success'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            error('Terjadi kesalahan: ' . $e->getMessage());
    
            return redirect()->route('signup')
                ->with("res-status", [
                    'msg' => "Terjadi kesalahan: " . $e->getMessage(),
                    'status' => 'danger'
                ]);
        }
    }
}
