@extends('layouts.authentication.master')
@section('title', 'Sign-up')

@section('css')
@endsection

@section('style')
@endsection


@section('content')
<div class="container-fluid p-0">
   <div class="row m-0">
      <div class="col-12 p-0">
         <div class="login-card">
            <div>
               <div>
                  <img class="for-light" src="{{asset('assets/images/ikankakap/logo/logo-text.png')}}" alt="looginpage"
                     style="max-width: 450px;">
                  <img class="for-dark" src="{{asset('assets/images/ikankakap/logo/logo-text.png')}}" alt="looginpage"
                     style="max-width: 450px;">
               </div>

               <div class="login-main">
                  @if (session('res-status'))
                  <div class="alert alert-{{session('res-status')['status']}}">
                     {{ session('res-status')['msg'] }}
                  </div>
                  @endif
                  <form class="theme-form" method="POST" action="/signup" novalidate="">
                     @csrf
                     <h4>Buat Akun Anda</h4>
                     <p>Masukkan data untuk membuat akun</p>
                     <div class="form-group">
                        <label class="col-form-label">Email</label>
                        <input class="form-control" type="email" required=""
                           placeholder="Masukkan nama email yang aktif" name="email" value="{{ old('email') }}">
                        @error('email')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                     </div>
                     <div class="form-group">
                        <label class="col-form-label">Nama Perusahaan / Agen</label>
                        <input class="form-control" type="text" required="" placeholder="Masukkan nama perusahaan/agen"
                           name="nama_perusahaan" value="{{ old('nama_perusahaan') }}">
                        @error('nama_perusahaan')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                     </div>
                     <div class="form-group">
                        <label class="col-form-label">Alamat Perusahaan</label>
                        <input class="form-control" type="text" required=""
                           placeholder="Masukkan alamat lengkap perusahaan" name="alamat_perusahaan"
                           value="{{ old('alamat_perusahaan') }}">
                        @error('alamat_perusahaan')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                     </div>
                     <div class="form-group">
                        <label class="col-form-label">Kota/Kabupaten</label>
                        <input class="form-control" type="text" required="" placeholder="Masukkan Kota/Kabupaten"
                           name="kotaOrKabupaten" value="{{ old('kotaOrKabupaten') }}">
                        @error('kotaOrKabupaten')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                     </div>
                     <div class="form-group">
                        <label class="col-form-label">No. Telepon/Handphone</label>
                        <input class="form-control" type="number" required=""
                           placeholder="Masukkan nomor telepon/handphone" name="noTelp" value="{{ old('noTelp') }}">
                        @error('noTelp')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                     </div>

                     <div class="form-group pt-2 mb-0">
                        <button class="btn btn-primary btn-block" type="submit">Buat Akun</button>
                     </div>
                     <p class="mt-4 mb-0">Sudah memiliki akun?<a class="ms-2" href="{{ route('login') }}">Sign
                           in</a></p>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection

@section('script')
@endsection