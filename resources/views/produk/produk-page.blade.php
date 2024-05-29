@extends('layouts.simple.master')
@section('title', 'Product Page')

@section('css')

@endsection

@section('style')
<link rel="stylesheet" type="text/css" href="/assets/css/vendors/sweetalert2.min.css">
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
             <img src="../{{ $product->fotoProduk }}" alt="" style="max-width: 100%; height: auto;">
           </div>
         </div>
       </div>
       <div class="col-xxl-4 box-col-6 order-xxl-0 order-1">
         <div class="card">
           <div class="card-body">
             <div class="product-page-details">
               <h3>{{ $product->namaProduk }}</h3>
             </div>
             <div class="product-price" style="color: #AB764E;">Rp{{ $product->hargaProduk }}</div>
             <hr>
             <p>{{ $product->deskripsiProduk }}</p>
             <hr>
             <div>
               <table class="product-page-width">
                <tbody>
                    <tr>
                        <td><b>Kategori</b></td>
                        <td>: {{ $product->kategoriProduk }}</td>
                    </tr>
                    <tr>
                        <td><b>Stok</b></td>
                        <td class="txt-success">
                            @if ($product->stokProduk)
                                : Tersedia
                            @else
                                : Tidak Tersedia
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td><b>Berat</b></td>
                        <td>: {{ $product->beratProduk }} ml</td>
                    </tr>
                </tbody>
               </table>
             </div>
           </div>
         </div>
       </div>
       <div class="col-xxl-4 col-md-6 box-col-6">
       <div class="card">
        <div class="card-body">
            <div class="filter-block">
                <h4>Siapkan Pesanan</h4>
                <div class="row align-items-center">
                    <div class="col-auto">
                        <button class="btn btn-primary btn-sm" id="decrease-quantity" style="padding: 0.25rem 0.5rem; font-size: 0.75rem;">-</button>
                    </div>
                    <div class="col-auto">
                        <span class="mx-2" id="quantity" style="font-size: 0.875rem;">1</span>
                    </div>
                    <div class="col-auto">
                        <button class="btn btn-primary btn-sm" id="increase-quantity" style="padding: 0.25rem 0.5rem; font-size: 0.75rem;">+</button>
                    </div>
                    <div class="col">
                        <p class="mt-2 mb-0">Sisa Stok: <span class="stock">{{ $product->stokProduk }}</span></p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col">
                        <p class="mb-0">Subtotal: <span class="subtotal" style="color: #AB764E;">Rp{{ $product->hargaProduk }}</span></p>
                    </div>
                </div>
                <div class="mt-3">
                    <button class="btn" style="background-color: #AB764E; color: white;" id="add-to-cart" type="submit" title=""> <i class="fa fa-shopping-basket me-1"></i>Add To Cart</button>
                </div>
            </div>
        </div>
      </div>
     </div>
   </div>
 </div>
</div>
@endsection

@section('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{asset('assets/js/rating/jquery.barrating.js')}}"></script>
<script src="{{asset('assets/js/owlcarousel/owl.carousel.js')}}"></script>
<script src="{{asset('assets/js/ecommerce.js')}}"></script>
<script src="/assets/js/sweet-alert/sweetalert2.all.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var quantity = 1;
        var price = {{ $product->hargaProduk }};
        var stock = {{ $product->stokProduk }};
        var subtotalElement = document.querySelector('.subtotal');
        var quantityElement = document.querySelector('#quantity');
        var stockElement = document.querySelector('.stock');

        function updateSubtotal() {
            var subtotal = quantity * price;
            subtotalElement.textContent = 'Rp' + subtotal;
        }

        function updateQuantity(newQuantity) {
            if (newQuantity >= 1 && newQuantity <= stock) {
                quantity = newQuantity;
                quantityElement.textContent = quantity;
                updateSubtotal();
            }
        }

        document.querySelector('#increase-quantity').addEventListener('click', function() {
            updateQuantity(quantity + 1);
        });

        document.querySelector('#decrease-quantity').addEventListener('click', function() {
            updateQuantity(quantity - 1);
        });

        document.querySelector('#add-to-cart').addEventListener('click', function(event) {
            event.preventDefault();
        
            var productId ='{{ $product->id }}';
            var quantity = parseInt(document.querySelector('#quantity').textContent);
            var totalPrice = quantity * '{{ $product->hargaProduk }}';
            
            var formData = new FormData();
            formData.append('id_produk', productId);
            formData.append('jumlah_produk', quantity);
            formData.append('total_harga', totalPrice);

            $.ajax({
                url: '/post-cart',
                type: 'POST', 
                data: formData,  
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    if (response.success) {
                        Swal.fire({
                            title: 'Berhasil',
                            text: response.message,
                            icon: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => {
                            window.location.href = "{{ route('produk') }}";
                        });
                    } else {
                        Swal.fire({
                            title: 'Gagal',
                            text: response.message,
                            icon: 'error',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    }
                },
                error: function (xhr, status, error) {
                    Swal.fire({
                        title: 'Gagal',
                        text: 'Terjadi kesalahan saat mengirim permintaan.',
                        icon: 'error',
                        timer: 2000,
                        showConfirmButton: false
                    });
                }
            });
        });
    });
</script>
@endsection

