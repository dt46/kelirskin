@extends('layouts.authentication.master')
@section('title', 'Login')

@section('css')
@endsection

@section('style')
@endsection

@section('content')
<div class="container-fluid p-0">
   <div class="row m-0">
      <div class="col-xl-7"><img class="bg-img-cover bg-center" src="{{asset('assets/images/login/2.jpg')}}" alt="looginpage"></div>
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
                     <h4>Sign in to account</h4>
                     <p>Enter your email & password to login</p>
                     <div class="form-group">
                        <label class="col-form-label">Email Address</label>
                        <input class="form-control" type="email" name="email" required="" value="{{ old('email') }}"
                           autofocus placeholder="Test@gmail.com">
                     </div>
                     <div class="form-group">
                        <label class="col-form-label">Password</label>
                        <input class="form-control" type="password" name="password" required="" placeholder="*********">
                        <div class="show-hide"><span class="show"> </span></div>
                     </div>
                     <div class="form-group mb-0">
                        <button class="btn btn-primary btn-block" type="submit">Sign in</button>
                     </div>
                     <p class="mt-4 mb-0">Don't have an account? <a class="ms-2" href="{{ route('signup') }}">Create Account</a></p>
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
