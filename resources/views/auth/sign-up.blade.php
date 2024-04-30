@extends('layouts.authentication.master')
@section('title', 'Sign-up')

@section('css')
@endsection

@section('style')
<style>
/* CSS */
/* Membuat input file menjadi persegi panjang */
input[type="file"] {
    width: 100%;
    padding: 20px;
    box-sizing: border-box;
    border: 2px solid #ccc;
    border-radius: 4px;
    background-color: #f8f8f8;
    height: auto;
    display: block;
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
               <div><a class="logo" style="text-align: center;"><img class="img-fluid for-light" src="{{asset('assets/images/kelirskin/logo kelirskin1.png')}}" alt="looginpage"></a></div>
               <div class="login-main">
                  @if (session('res-status'))
                    <div class="alert alert-{{session('res-status')['status']}}">
                        {{ session('res-status')['msg'] }}
                    </div>
                  @endif
                  <form class="theme-form" method="POST" action="/signup" enctype="multipart/form-data" >
                     @csrf
                     <h4>Create your account</h4>
                     <p>Enter your email and password</p>
                     <div class="form-group">
                        <label class="col-form-label">Email</label>
                        <input class="form-control" type="email" required=""
                           placeholder="Enter your active email" name="email" value="{{ old('email') }}">
                        @error('email')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                     </div>
                     <div class="form-group">
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
                        @error('nama')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                     </div>
                     <div class="form-group">
                        <label class="col-form-label">No Handphone</label>
                        <input class="form-control" type="number" required=""
                           placeholder="Enter your phone number" name="no_hp" value="{{ old('no_hp') }}">
                        @error('no_hp')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                     </div>
                     <div class="form-group">
                        <label class="col-form-label">Provinsi</label>
                        <input class="form-control" type="text" required=""
                           placeholder="Provinsi" name="provinsi" value="{{ old('provinsi') }}">
                        @error('provinsi')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                     </div>
                     <div class="row">
                        <div class="col-md-6">
                           <label class="col-form-label">Kota</label>
                           <input class="form-control" type="text" required=""
                              placeholder="Kota" name="kota" value="{{ old('kota') }}">
                           @error('kota')
                           <small class="text-danger">{{ $message }}</small>
                           @enderror
                        </div>
                        <div class="col-md-6">
                           <label class="col-form-label">Kecamatan</label>
                           <input class="form-control" type="text" required=""
                              placeholder="Kecamatan" name="kecamatan" value="{{ old('kecamatan') }}">
                           @error('kecamatan')
                           <small class="text-danger">{{ $message }}</small>
                           @enderror
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-form-label">Alamat Lengkap</label>
                        <input class="form-control" type="text" required=""
                           placeholder="Enter your full address" name="alamat_detail" value="{{ old('alamat_detail') }}">
                        @error('alamat_detail')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                     </div>
                     <div class="form-group">
                        <label class="col-form-label">Upload Foto KTP</label>
                        <input type="file" class="form-control-file" id="uploadKTP" name="foto_ktp" value="{{ old('foto_ktp') }}">
                        <small class="form-text text-muted">Please upload a square photo of your KTP.</small>
                        @error('foto_ktp')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                     </div>
                     <div class="form-group mb-0">
                        <button class="btn btn-primary btn-block" type="submit">Create Account</button>
                     </div>
                  </form>
                  <p class="mt-4 mb-0">Already have an account?<a class="ms-2" href="{{ route('signin') }}">Sign in</a></p>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection

@section('script')
@endsection