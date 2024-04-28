@extends('layouts.authentication.master')
@section('title', 'Sign-up-one')

@section('css')
@endsection

@section('style')
<style>
/* CSS */
/* Membuat input file menjadi persegi panjang */
input[type="file"] {
    width: 100%;
    padding: 20px; /* Ubah sesuai kebutuhan */
    box-sizing: border-box;
    border: 2px solid #ccc;
    border-radius: 4px;
    background-color: #f8f8f8;
    height: auto; /* Menyesuaikan tinggi sesuai lebar */
    display: block; /* Membuat input file menjadi blok */
}

/* Memastikan tampilan input file yang konsisten */
input[type="file"]:focus {
    outline: none;
    border-color: #4CAF50;
}

</style>

@endsection

@section('content')
<div class="container-fluid p-0">
   <div class="row m-0">
      <div class="col-xl-5"><img class="bg-img-cover bg-center" src="{{asset('assets/images/login/3.jpg')}}" alt="looginpage"></div>
      <div class="col-xl-7 p-0">
         <div class="login-card">
            <div>
               <div><a class="logo" href="{{ route('index') }}"><img class="img-fluid for-light" src="{{asset('assets/images/logo/login.png')}}" alt="looginpage"><img class="img-fluid for-dark" src="{{asset('assets/images/logo/logo_dark.png')}}" alt="looginpage"></a></div>
               <div class="login-main">
                  <form class="theme-form">
                     @csrf
                     <h4>Create your account</h4>
                     <p>Enter your email and password</p>
                     <div class="form-group" action="/signup" method="post">
                        <!-- Input Email -->
                        <label class="col-form-label">Email</label>
                        <input class="form-control" type="email" required=""
                           placeholder="Enter your active email" name="email" value="{{ old('email') }}">
                        @error('email')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                     </div>
                     <div class="form-group">
                        <!-- Input Password -->
                        <label class="col-form-label">Password</label>
                        <input class="form-control" type="password" required=""
                           placeholder="************" name="password" value="{{ old('password') }}">
                        @error('password')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                        <div class="show-hide"><span class="show"></span></div>
                     </div>
                     <div class="form-group">
                        <label class="col-form-label">Nama</label>
                        <input class="form-control" type="text" required=""
                           placeholder="Enter your name" name="nama" value="{{ old('nama') }}">
                        @error('email')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                     </div>
                     <!-- Input No Handphone -->
                     <div class="form-group">
                        <label class="col-form-label">No Handphone</label>
                        <input class="form-control" type="number" required=""
                           placeholder="Enter your phone number" name="no_hp" value="{{ old('no_hp') }}">
                        @error('no_hp')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                     </div>
                     <!-- Input Provinsi -->
                     <div class="form-group">
                        <label class="col-form-label">Provinsi</label>
                        <input class="form-control" type="text" required=""
                           placeholder="Provinsi" name="provinsi" value="{{ old('provinsi') }}">
                        @error('provinsi')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                     </div>
                     <!-- Input Kota dan Kecamatan -->
                     <div class="row">
                        <div class="col-md-6">
                           <label class="col-form-label">Kota</label>
                           <input class="form-control" type="text" required=""
                              placeholder="Kota" name="kota" value="{{ old('email') }}">
                           @error('kota')
                           <small class="text-danger">{{ $message }}</small>
                           @enderror
                        </div>
                        <div class="col-md-6">
                           <label class="col-form-label">Kecamatan</label>
                           <input class="form-control" type="text" required=""
                              placeholder="Kecamatan" name="kecamatan" value="{{ old('email') }}">
                           @error('kecamatan')
                           <small class="text-danger">{{ $message }}</small>
                           @enderror
                        </div>
                     </div>
                     <!-- Input Alamat Lengkap -->
                     <div class="form-group">
                        <label class="col-form-label">Alamat Lengkap</label>
                        <input class="form-control" type="text" required=""
                           placeholder="Enter your full address" name="alamat_detail" value="{{ old('alamat)_detail') }}">
                        @error('alamat_detail')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                     </div>
                     <div class="form-group">
                        <label class="col-form-label">Upload Foto KTP</label>
                        <input type="file" class="form-control-file" id="uploadKTP" name="foto_ktp">
                        <small class="form-text text-muted">Please upload a square photo of your KTP.</small>
                     </div>
                     <div class="form-group mb-0">
                        <div class="checkbox p-0">
                           <input id="checkbox1" type="checkbox">
                           <label class="text-muted" for="checkbox1">Agree with<a class="ms-2" href="#">Privacy Policy</a></label>
                        </div>
                        <button class="btn btn-primary btn-block" type="submit">Create Account</button>
                     </div>
                     <p class="mt-4 mb-0">Already have an account?<a class="ms-2" href="{{ route('signin') }}">Sign in</a></p>
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