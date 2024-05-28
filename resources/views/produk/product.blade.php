@extends('layouts.simple.master')
@section('title', 'Product')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/select2.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/owlcarousel.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/range-slider.css')}}">
@endsection

@section('style')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/select2.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/owlcarousel.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/range-slider.css')}}">
<style>
  .product-grid .row {
  display: flex;
  flex-wrap: wrap;
}

.product-grid .row > [class*='col-'] {
  display: flex;
  flex-direction: column;
}

.form-inline {
  display: flex;
  align-items: center;
}

.filter-group {
  display: flex;
  margin-left: 10px;
}

.filter-group label {
  margin-right: 10px;
  margin-bottom: 0;
}

.filter-group input {
  margin-right: 5px;
}

</style>
@endsection

@section('breadcrumb-title')
<h3>Product</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item active">Product</li>
@endsection

@section('content')
<div class="container-fluid product-wrapper">
   <div class="product-grid">
    <div class="feature-products">
        <div class="row">
            <div class="col-sm-3">
                <div class="product-sidebar">
                    <div class="filter-section">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="mb-0 f-w-600">Filters<span class="pull-right"><i class="fa fa-chevron-down toggle-data"></i></span></h6>
                            </div>
                            <div class="left-filter">
                                <div class="card-body filter-cards-view animate-chk">
                                <div class="product-filter">
                                    <h6 class="f-w-600">Category</h6>
                                    @foreach($categories as $category)
                                    <div class="form-check">
                                        <input class="form-check-input category-filter" type="checkbox" name="category[]" id="{{ $category }}" value="{{ $category }}">
                                        <label class="form-check-label" for="{{ $category }}">
                                            {{ $category }}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9 col-sm-12">
            <form action="{{ route('produk') }}" method="GET">
                <div class="form-group m-0">
                    <input class="form-control" type="search" name="search" placeholder="Search.." data-original-title="" title="">
                    <i class="fa fa-search"></i>
                </div>
            </form>
            </div>
        </div>
        </div>
     </div>
     <div class="product-wrapper-grid">
       <div class="row">
         @foreach($products as $product)
         <div class="col-xl-3 col-sm-6 xl-4">
           <div class="card">
             <div class="product-box">
               <div class="product-img">
                 <img class="img-fluid" src="{{ $product->fotoProduk }}" alt="">
               </div>
               <div class="product-details">                 
                    <a href="{{ route('produk-page', ['id' => $product->id]) }}">
                    <h4>{{ $product->namaProduk }}</h4></a>
                  <p>{{ $product->deksripsiProduk }}</p>
                  <p class="mt-0 txt-success">
                    @if ($product->stokProduk)
                        Tersedia
                    @else
                        Tidak Tersedia
                    @endif
                  </p>
                  <p>{{ $product->beratProduk }} gram</p>
                  <div class="product-price" style="color: #AB764E;">Rp{{ $product->hargaProduk }}</div>
               </div>
             </div>
           </div>
         </div>
         @endforeach
       </div>
     </div>
   </div>
</div>
@endsection

@section('script')
<script src="{{asset('assets/js/range-slider/ion.rangeSlider.min.js')}}"></script>
<script src="{{asset('assets/js/range-slider/rangeslider-script.js')}}"></script>
<script src="{{asset('assets/js/touchspin/vendors.min.js')}}"></script>
<script src="{{asset('assets/js/touchspin/touchspin.js')}}"></script>
<script src="{{asset('assets/js/touchspin/input-groups.min.js')}}"></script>
<script src="{{asset('assets/js/owlcarousel/owl.carousel.js')}}"></script>
<script src="{{asset('assets/js/select2/select2.full.min.js')}}"></script>
<script src="{{asset('assets/js/select2/select2-custom.js')}}"></script>
<script src="{{asset('assets/js/product-tab.js')}}"></script>
@endsection
