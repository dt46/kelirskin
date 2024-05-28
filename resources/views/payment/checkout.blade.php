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
                    <h5 class="mb-3">Total Pembayaran</h5>
                    <strong><span id="total-price" style="color: #AB764E; font-size: 20px;">Rp{{ $totalHarga }}</span></strong>
                    <hr>
                    <h5 class="mb-3">Pembayaran</h5>
                    <select id="metode_pembayaran" name="metode_pembayaran" class="form-control mb-3">
                        <option value="" disabled selected>Pilih Metode Pembayaran</option>
                        <option value="BCA">BCA</option>
                        <option value="BNI">BNI</option>
                        <option value="BRI">BRI</option>
                        <option value="DANA">DANA</option>
                        <option value="Gopay">Gopay</option>
                        <option value="OVO">OVO</option>
                    </select>
                    <h5>Nomor Rekening</h5>
                    <strong class="mb-5"><span id="total-price" style="color: #AB764E; font-size: 20px;">2850099432</span></strong>
                    <h5>Petunjuk Transfer</h5>
                    <span style="color: grey;">1. Pilih "Transfer Antar Rekening</span><br>
                    <span style="color: grey;">2. Masukkan informasi rekening tujuan, nominal transfer dan berita</span><br>
                    <span style="color: grey;">3. Pastikan kembali informasi transfer sudah benar</span><br>
                    <span style="color: grey;">4. Konfirmasi dengan memasukkan PIN BCA mobile</span><br>
                    <span style="color: grey;">5. Transfer ke sesama rekening BCA berhasil</span>
                </div>
            </div>
        </div>
        <div class="col-lg-5 col-md-5 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h5>Upload Bukti Pembayaran</h5>
                    <input type="file" id="bukti_pembayaran" name="bukti_pembayaran" accept="image/jpeg,image/png,image/jpg" class="form-control">
                    <small class="form-text text-muted">Format didukung : JPG/JPEG/PNG</small>
                    @foreach($id_cart as $cart)
                        <input type="hidden" name="id_cart[]" value="{{ $cart->id }}">
                    @endforeach
                    <div class="mb-3 mt-3" hidden>
                        <h7 style="color: grey;">Total Harga ( Produk)</h7>
                        <span style="margin-left: 85px;" id="total-products">Rp{{ $totalHarga }}</span><br>
                        <h7 style="color: grey;">Total Ongkos Kirim</h7>
                        <span style="margin-left: 112px;" id="total-ongkir">Rp10000</span><br>
                        <h7 style="color: grey;">Biaya Layanan Aplikasi</h7>
                        <span style="margin-left: 82px;" id="total-aplikasi">Rp1000</span>
                    </div>
                    <hr>
                    <div class="mt-3">
                        <button id="submit-order" class="btn w-100" style="background-color: #AB764E; color: white;">Buat Pesanan</button>
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

    $('#submit-order').on('click', function() {
        const biaya_layananAplikasi = 1000;
        const ongkos_kirim = 10000; 
        const tanggal = new Date().toISOString().slice(0, 19).replace('T', ' ');
        const total_harga = parseInt(document.getElementById('total-price').innerText.replaceAll(',', '').replace(/[^\d.-]/g, ''));   
        const formData = new FormData();
        
        const selectedMetodePembayaran = document.getElementById('metode_pembayaran').value;
        if (!selectedMetodePembayaran) {
            alert('Pilih metode pembayaran terlebih dahulu.');
            return;
        }

        formData.append('tanggal', tanggal);
        formData.append('ongkos_kirim', ongkos_kirim);
        formData.append('biaya_layananAplikasi', biaya_layananAplikasi);
        formData.append('total_harga', total_harga);
        formData.append('bukti_pembayaran', document.getElementById('bukti_pembayaran').files[0]);
        formData.append('metode_pembayaran', selectedMetodePembayaran);
        
        const idCartElements = document.querySelectorAll('input[name="id_cart[]"]');
        idCartElements.forEach(function(element) {
            formData.append('id_cart[]', element.value);
        });

        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        $.ajax({
            url: '/payment',
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            processData: false,
            contentType: false,
            data: formData,
            success: function(response) {
                console.log(response);
                window.location.href = 'produk'; 
            },
            error: function(response) {
                console.log(response);
                alert('Terjadi kesalahan. Silakan coba lagi.');
            }
        });
    });
});
    </script>
@endsection
