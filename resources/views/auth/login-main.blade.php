@extends('layouts.authentication.master')
@section('title', 'Login Admin')

@section('css')

@endsection

@section('style')
<link rel="stylesheet" type="text/css" href="/assets/css/vendors/sweetalert2.css">
<style>
   .wide-button {
      width: 100%;
      padding: 10px;
      font-size: 16px;
   }
</style>
@endsection

@section('content')
<div class="container-fluid">
   <div class="row">
      <div class="col-12 p-0">
         <div class="login-card">
            <div>
               <div style="text-align: center;">
                  <img class="for-light" style="text-align: center;" src="/assets/images/kelirskin/logo kelirskin1.png" alt="looginpage"
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
                     <center>
                        <h4>Kelirskin Admin Access</h4>
                        <p>Selamat datang dan selamat bekerja.</p>
                     </center>
                     <div class="form-group">
                        <label class="col-form-label">Email</label>
                        <input class="form-control" type="email" name="email" value="{{ old('email') }}" required=""
                           placeholder="email@gmail.com">
                     </div>
                     <div class="form-group">
                        <label class="col-form-label">Password</label>
                        <input class="form-control" type="password" name="password" required="" placeholder="*********">
                        <div class="show-hide"><span class="show"> </span></div>
                     </div>
                     <div class="form-group pt-2 mb-0">
                        <button class="btn btn-primary wide-button" type="submit">Sign in</button>
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