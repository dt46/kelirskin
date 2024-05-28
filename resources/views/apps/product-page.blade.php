@extends('layouts.simple.master')
@section('title', 'Product Page')

@section('css')

@endsection

@section('style')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/owlcarousel.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/rating.css')}}">
@endsection

@section('breadcrumb-title')
<h3>Product Page</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item active">Product Page</li>
@endsection

@section('content')
<div class="container-fluid">
   <div>
     <div class="row product-page-main p-0">
       <div class="col-xxl-4 col-md-6 box-col-12">
         <div class="card">
           <div class="card-body">
             <div class="product-slider owl-carousel owl-theme" id="sync1">
               <div class="item"><img src="{{ asset('assets/images/ecommerce/01.jpg') }}" alt=""></div>
             </div>
           </div>
         </div>
       </div>
       <div class="col-xxl-5 box-col-6 order-xxl-0 order-1">
         <div class="card">
           <div class="card-body">
             <div class="product-page-details">
               <h3>Women Pink shirt.</h3>
             </div>
             <div class="product-price">$26.00  
             </div>
             <hr>
             <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that.</p>
             <hr>
             <div>
               <table class="product-page-width">
                 <tbody>
                   <tr>
                     <td> <b>Brand &nbsp;&nbsp;&nbsp;:</b></td>
                     <td>Pixelstrap</td>
                   </tr>
                   <tr>
                     <td> <b>Availability &nbsp;&nbsp;&nbsp;: &nbsp;&nbsp;&nbsp;</b></td>
                     <td class="txt-success">In stock</td>
                   </tr>
                   <tr>
                     <td> <b>Seller &nbsp;&nbsp;&nbsp;: &nbsp;&nbsp;&nbsp;</b></td>
                     <td>ABC</td>
                   </tr>
                   <tr>
                     <td> <b>Fabric &nbsp;&nbsp;&nbsp;: &nbsp;&nbsp;&nbsp;</b></td>
                     <td>Cotton</td>
                   </tr>
                 </tbody>
               </table>
             </div>
             <hr>
             <div class="m-t-15 btn-showcase"><a class="btn btn-primary" href="{{ route('cart')}}" title=""> <i class="fa fa-shopping-basket me-1"></i>Add To Cart</a></div>
           </div>
         </div>
       </div>
       <div class="col-xxl-3 col-md-6 box-col-6">
         <div class="card">
           <div class="card-body">
             <div class="filter-block">
               <h4>Brand</h4>
               <ul>
                 <li>Clothing</li>
                 <li>Bags</li>
                 <li>Footwear</li>
                 <li>Watches</li>
                 <li>ACCESSORIES</li>
               </ul>
             </div>
           </div>
         </div>
           <!-- silde-bar colleps block end here-->
       </div>
     </div>
   </div>
 </div>
@endsection

@section('script')
<script src="{{asset('assets/js/sidebar-menu.js')}}"></script>
<script src="{{asset('assets/js/rating/jquery.barrating.js')}}"></script>
<script src="{{asset('assets/js/rating/rating-script.js')}}"></script>
<script src="{{asset('assets/js/owlcarousel/owl.carousel.js')}}"></script>
<script src="{{asset('assets/js/ecommerce.js')}}"></script>
@endsection