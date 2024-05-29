@extends('layouts.simple.master')
@section('title', 'Change Profile')

@section('css')
@endsection

@section('style')
<link rel="stylesheet" type="text/css" href="/assets/css/vendors/date-picker.css">
<link rel="stylesheet" type="text/css" href="/assets/css/vendors/tom-select.bootstrap5.css">
<link rel="stylesheet" href="/assets/js/datatable/dataTables.dataTables.min.css">
<link rel="stylesheet" href="/assets/js/datatable/fixedColumns.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="/assets/css/vendors/sweetalert2.min.css">

<style>
.square-image {
    margin: auto;
    display: block;
    width: 200px;
    height: 200px;
    object-fit: cover;
}

.custom-button {
    background-color: white;
    border: 1px solid brown;
    color: brown;
    padding: 6px 12px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 14px;
    border-radius: 4px;
    cursor: pointer;
}

.custom-button:hover {
    background-color: brown;
    color: white;
}
</style>
@endsection

@section('breadcrumb-title')
<h3>Change Password</h3>
@endsection

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h5>Change Password</h5>
        </div>
        <div class="card-body">
            <form id="form-update-reseller" class="theme-form" enctype="multipart/form-data" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-4 text-center">
                        <div class="mt-2 mx-auto" style="width: 200px; height: 200px;">
                            @if(auth()->user()->reseller->foto_profil)
                            <img src="{{ auth()->user()->reseller->foto_profil }}" alt="Foto Profil" class="square-image">
                            @else
                            <img src="/assets/images/profil-preview.jpg" alt="Foto Profil" class="square-image">
                            @endif
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="row mb-3">
                            <h5>Kata Sandi Baru</h5>
                            <p class="col-md-12">Ubah kata sandi anda dengan yang lebih kuat <br> demi keamanan akun anda.</p>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-8">
                                <input class="form-control" id="password" name="password" type="password" placeholder="Masukkan Kata Sandi Baru">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-8">
                                <input class="form-control" id="password_confirmation" name="password_confirmation" type="password" placeholder="Ketik Ulang Kata Sandi Baru">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-8">
                                <a href="{{ route('profile') }}" class="btn custom-button" id="btn-save-password">Batal</a>
                                <button type="button" class="btn custom-button" id="btn-change-password">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="/assets/js/select2/select2.full.min.js"></script>
<script src="/assets/js/select2/select2-custom.js"></script>
<script src="/assets/js/datatable/dataTables.min.js"></script>
<script src="/assets/js/datatable/datatable-extension/dataTables.buttons.min.js"></script>
<script src="/assets/js/datatable/datatable-extension/jszip.min.js"></script>
<script src="/assets/js/datatable/datatable-extension/buttons.html5.min.js"></script>
<script src="/assets/js/datatable/datatable-extension/dataTables.fixedColumns.min.js"></script>
<script src="/assets/js/datepicker/date-picker/datepicker.js"></script>
<script src="/assets/js/datepicker/date-picker/datepicker.en.js"></script>
<script src="/assets/js/datepicker/date-picker/datepicker.custom.js"></script>
<script src="/assets/js/sweet-alert/sweetalert2.all.min.js"></script>

<script>
    (function () {
        $('#btn-change-password').click(function () {
            var password = $('#password').val();
            var passwordConfirmation = $('#password_confirmation').val();

            if (password !== passwordConfirmation) {
                Swal.fire({
                    title: 'Gagal',
                    text: 'Kata sandi dan konfirmasi kata sandi tidak cocok.',
                    icon: 'error',
                    timer: 2000,
                    showConfirmButton: false
                });
                return;
            }

            var formData = new FormData($('#form-update-reseller')[0]);
            $.ajax({
                url: '/change-password',
                type: 'POST',
                data: formData,
                dataType: 'json',
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    if (response.status) {
                        Swal.fire({
                            title: 'Berhasil',
                            text: response.message,
                            icon: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    } else {
                        Swal.fire({
                            title: 'Gagal',
                            text: response.error,
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
    })();
</script>
@endsection
