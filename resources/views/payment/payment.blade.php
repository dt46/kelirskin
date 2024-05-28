@extends('layouts.simple.master')
@section('title', 'Checkout')

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
    <h3>Checkout</h3>
@endsection

@section('content')
 <div class="container-fluid">
    <div class="row">
        <div class="col-lg-7 col-md-7 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-3">Produk Pesanan</h5>
                    <table id="tabel-keranjang" class="cell-border">
                    </table>
                    <hr>
                    <h5 class="mb-3">Alamat Pengiriman</h5>
                    <span>{{ $alamat }}</span> <br>
                    <strong><span>{{ $no_hp }}</span></strong>
                </div>
            </div>
        </div>
        <div class="col-lg-5 col-md-5 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h5>Rincian Belanja</h5>
                    <div class="mb-3 mt-3">
                        <h7 style="color: grey;">Total Harga ({{ $countCart }} Produk)</h7>
                        <span style="margin-left: 15px;" id="total-products">Rp{{ $totalHarga }}</span><br>
                        <h7 style="color: grey;">Total Ongkos Kirim</h7>
                        <span style="margin-left: 42px;" id="total-ongkir">Rp10000</span><br>
                        <h7 style="color: grey;">Biaya Layanan Aplikasi</h7>
                        <span style="margin-left: 14px;" id="total-aplikasi">Rp1000</span>
                    </div>
                    <hr>
                    <div>
                        <h7 style="color: grey;">Total Harga</h7>
                        <strong><span id="total-price" style="margin-left: 95px;">Rp{{ $totalHarga }}</span></strong>
                    </div>
                    <div class="mt-3">
                        <a href="{{ route('payment') }}" class="btn w-100" style="background-color: #AB764E; color: white;">Buat Pesanan</a>
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
        ],
        columnDefs: [
            {
                visible: false,
            }
        ]
    });

    function calculateTotalPrice() {
        var totalProduct = parseInt($("#total-products").text().replace("Rp", "").replace(",", ""));
        var totalOngkir = parseInt($("#total-ongkir").text().replace("Rp", "").replace(",", ""));
        var totalAplikasi = parseInt($("#total-aplikasi").text().replace("Rp", "").replace(",", ""));
        
        var totalPrice = totalProduct + totalOngkir + totalAplikasi;
        return totalPrice;
    }

    function updateTotalPrice() {
        var totalPrice = calculateTotalPrice();
        $('#total-price').text('Rp' + totalPrice.toLocaleString()); 
    }

    updateTotalPrice();
});
    </script>
@endsection
