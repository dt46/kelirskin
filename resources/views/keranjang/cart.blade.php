@extends('layouts.simple.master')
@section('title', 'Cart')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/datatables.min.css') }}">
    <style>
        .action-buttons {
            display: flex;
            align-items: center;
        }
        .action-buttons button {
            margin: 0 5px;
        }
    </style>
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h3>Keranjang</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item active">Keranjang</li>
@endsection

@section('content')
 <div class="container-fluid">
    <div class="row">
        <div class="col-lg-8 col-md-7 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5 style="color: #AB764E;">Keranjang</h5>
                </div>
                <div class="card-body">
                    <table id="tabel-keranjang" class="cell-border">
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-5 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h5>Tinggal Klik Beli!</h5>
                    <div class="mb-3 mt-3">
                        <h7 style="color: grey;">Jumlah Produk:</h7><br>
                        <strong><span id="total-products">{{ $countCart }} Produk</span></strong>
                    </div>
                    <hr>
                    <div>
                        <h7 style="color: grey;">Total Harga:</h7><br>
                        <strong><span id="total-price" style="color: #AB764E;">Rp{{ $totalHarga }}</span></strong>
                    </div>
                    <div class="mt-3">
                        <a href="{{ route('checkout-produk') }}" class="btn btnSubmit w-100" style="background-color: #AB764E; color: white;">Beli</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script src="/assets/js/datatable/dataTables.min.js"></script>
    <script src="/assets/js/datatable/datatable-extension/dataTables.buttons.min.js"></script>
    <script src="/assets/js/datatable/datatable-extension/dataTables.fixedColumns.min.js"></script>

    <script>
$(document).ready(function() {
    const tableCart = $('#tabel-keranjang').DataTable({
        scrollX: true,
        dom: 'Bfrtip',
        searching: false,
        sorting: false,
        info: false,
        ordering: false,
        paging: false,
        buttons: [],
        ajax: {
            url: '/keranjang',
            type: 'GET',
            dataSrc: function (json) {
                return json.data;
            }
        },
        columns: [
            {
                data: null,
                render: function (data, type, row) {
                    return `
                        <div class="d-flex align-items-center">
                            <img src="${row.fotoProduk}" alt="${row.namaProduk}" width="50" class="me-2">
                            <div>
                                <span>${row.namaProduk}</span><br>
                                <strong><span>Rp${row.total_harga}</span></strong>
                            </div>
                        </div>
                    `;
                },
            },
            {
                data: null,
                render: function (data, type, row) {
                    return `
                        <div class="action-buttons">
                            <button class="btn btn-xs btn-danger delete-btn" data-id="${row.id}"><i class="fas fa-trash"></i></button>
                            <button class="btn btn-xs btn-primary minus-btn" style="border-radius: 50%;" data-id="${row.id}">-</button>
                            <span class="quantity">${row.jumlah_produk}</span>
                            <button class="btn btn-xs btn-primary plus-btn" style="border-radius: 50%;" data-id="${row.id}">+</button>
                            <span type="number" class="harga-produk" hidden>${row.hargaProduk}</span>
                        </div>
                    `;
                },
                className: 'text-center'
            }
        ],
        columnDefs: [
            {
                visible: false,
            }
        ]
    });

    function checkCartData() {
        var totalProducts = parseInt($('#total-products').text());
        if (totalProducts === 0) {
            $('.btnSubmit').removeAttr('href'); 
            $('.btnSubmit').addClass('disabled'); 
        } else {
            $('.btnSubmit').attr('href', '{{ route("checkout-produk") }}'); 
            $('.btnSubmit').removeClass('disabled'); 
        }
    }

    checkCartData();

    $('#tabel-keranjang').on('click', '.plus-btn', function() {
        var rowId = $(this).data('id');
        var quantityElement = $(this).siblings('.quantity');
        var priceElement = $(this).siblings('.harga-produk');
        var currentQuantity = parseInt(quantityElement.text());
        var currentPrice = parseInt(priceElement.text());
        var newQuantity = currentQuantity + 1;
        var newHarga = newQuantity * currentPrice;
        quantityElement.text(newQuantity);

        updateQuantity(rowId, newQuantity, newHarga);
    });

    $('#tabel-keranjang').on('click', '.minus-btn', function() {
        var rowId = $(this).data('id');
        var quantityElement = $(this).siblings('.quantity');
        var priceElement = $(this).siblings('.harga-produk');
        var currentQuantity = parseInt(quantityElement.text());
        var currentPrice = parseInt(priceElement.text());
        var newQuantity = currentQuantity > 1 ? currentQuantity - 1 : 1;
        var newHarga = newQuantity * currentPrice;
        quantityElement.text(newQuantity);

        updateQuantity(rowId, newQuantity, newHarga);
    });

    function updateQuantity(rowId, newQuantity, newHarga) {
        $.ajax({
            url: '/update-quantity/' + rowId,
            type: 'PUT',
            contentType: 'application/json',
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: JSON.stringify({
                jumlah_produk: newQuantity,
                total_harga: newHarga
            }),
            success: function(response) {
                $('#tabel-keranjang').DataTable().ajax.reload(null, false);
                $('#total-price').html('Rp' + response.totalHarga);
            },
            error: function(xhr) {
            }
        });
    }

    $('#tabel-keranjang').on('click', '.delete-btn', function() {
        var rowId = $(this).data('id');

        if (confirm("Apakah Anda yakin ingin menghapus item ini?")) {
            $.ajax({
                url: '/delete-cart/' + rowId, 
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $('#tabel-keranjang').DataTable().ajax.reload(null, false);
                    $('#total-price').html('Rp' + 0);
                    $('#total-products').html(0 + ' Produk');
                },
                error: function(xhr) {
                    console.error('Delete error:', xhr);
                }
            });
        }
    });
});

    </script>
@endsection
