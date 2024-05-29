@extends('layouts.authentication.master')
@section('title', 'Login')

@section('css')
@endsection

@section('style')
<style>
   .btn-block {
    width: 100%;
}
</style>
@endsection

@section('content')
<div class="container-fluid p-0">
   <div class="row m-0">
      <div class="col-xl-7"><img class="bg-img-cover bg-center" src="{{asset('assets/images/assetsss.jpg')}}" alt="looginpage"></div>
      <div class="col-xl-5 p-0">
         <div class="login-card">
            <div>
               <div><a class="logo text-start text-center"><img class="img-fluid for-light" src="{{asset('assets/images/kelirskin/logo kelirskin1.png')}}" alt="looginpage"></a></div>
               <div class="login-main">
                  @if(session()->has('loginFailed'))
                  <div class="alert alert-warning dark" role="alert">
                     <p>{{ session('loginFailed') }}</p>
                  </div>
                  @endif
                  @if(session()->has('success'))
                  <div class="alert alert-success dark" role="alert">
                     {{ session('success') }}
                  </div>
                  @endif
                  @if (session('res-status'))
                  <div class="alert alert-{{session('res-status')['status']}}">
                     {{ session('res-status')['msg'] }}
                  </div>
                  @endif
                  <form class="theme-form" method="post" action="/signin">
                     @csrf
                     <h4>Ayo Masuk Kembali!</h4>
                     <p class="mt-4 mb-0">Belum pernah daftar? <a class="ms-2" href="{{ route('signup') }}">Daftar</a> dulu yuk</p>
                     <div class="form-group">
                        <label class="col-form-label">Email</label>
                        <input class="form-control" type="email" name="email" required="" value="{{ old('email') }}"
                           autofocus placeholder="email@gmail.com">
                     </div>
                     <div class="form-group">
                        <label class="col-form-label">Password</label>
                        <input class="form-control" type="password" name="password" required="" placeholder="*********">
                        <div class="show-hide"><span class="show"> </span></div>
                     </div>
                     <div class="form-group mt-3">
                        <button class="btn btn-primary btn-block" type="submit">Masuk</button>
                     </div>
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
