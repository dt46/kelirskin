@extends('layouts.simple.master')
@section('title', 'Cart')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h3>Cart</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item active">Cart</li>
@endsection

@section('content')
 <div class="container-fluid">
    <div class="row">
        <div class="col-lg-8 col-md-7 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Cart</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="order-history table-responsive wishlist">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-5 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Tinggal Klik Beli!</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <h7 style="color: grey;">Jumlah Produk:</h7><br>
                        <strong><span id="total-products">0 Produk</span></strong>
                    </div>
                    <hr>
                    <div>
                        <h7 style="color: grey;">Total Harga:</h7><br>
                        <strong><span id="total-price" style="color: #AB764E;">Rp0.00</span></strong>
                    </div>
                    <div class="mt-3">
                        <button class="btn w-100" id="add-to-cart" type="submit" style="background-color: #AB764E; color: white;">Beli</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script src="{{ asset('assets/js/touchspin/vendors.min.js') }}"></script>
    <script src="{{ asset('assets/js/touchspin/touchspin.js') }}"></script>
    <script src="{{ asset('assets/js/touchspin/input-groups.min.js') }}"></script>
@endsection
