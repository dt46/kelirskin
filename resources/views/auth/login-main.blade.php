@extends('layouts.authentication.master')
@section('title', 'Login-sa-validation')

@section('css')

@endsection

@section('style')
<link rel="stylesheet" type="text/css" href="/assets/css/vendors/sweetalert2.css">
@endsection

@section('content')
<div class="container-fluid">
   <div class="row">
      <div class="col-12 p-0">
         <div class="login-card">
            <div>
               <div>
                  <img class="for-light" src="/assets/images/ikankakap/logo/logo-text.png" alt="looginpage"
                     style="max-width: 450px;">
                  <img class="for-dark" src="/assets/images/ikankakap/logo/logo-text.png" alt="looginpage"
                     style="max-width: 450px;">
               </div>

               <div class="login-main">
                  @if(session()->has('loginFailed'))
                  <div class="alert alert-warning dark" role="alert">
                     <p>{{ session('loginFailed') }}</p>
                  </div>
                  @endif
                  <form class="theme-form" method="post" action="/signin">
                     @csrf
                     <h4>Masuk ke akun anda</h4>
                     <p>Masukkan email dan password untuk masuk</p>
                     <div class="form-group">
                        <label class="col-form-label">Email Address</label>
                        <input class="form-control" type="email" name="email" value="{{ old('email') }}" required=""
                           placeholder="Test@gmail.com">
                     </div>
                     <div class="form-group">
                        <label class="col-form-label">Password</label>
                        <input class="form-control" type="password" name="password" required="" placeholder="*********">
                        <div class="show-hide"><span class="show"> </span></div>
                     </div>
                     <div class="form-group pt-2 mb-0">
                        <button class="btn btn-primary btn-block" type="submit">Sign in</button>
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
<script src="/assets/js/sweet-alert/sweetalert.min.js"></script>
<script>
   $(document).on('click', '#error', function(e) {
      if($('.email').val() == '' || $('.pwd').val() == ''){
         swal(
            "Error!", "Sorry, looks like some data are not filled, please try again !", "error"           
         )
      }
   });

   $('button[type="submit"]').on('click', function(){
      toggleStatusBtn(true, 'button[type="submit"]');

      $('form[action="/signin"]').submit();
   });
</script>
@endsection