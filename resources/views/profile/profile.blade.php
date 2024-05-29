@extends('layouts.simple.master')
@section('title', 'Profile')

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
<h3>Profile</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item active">Profile</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h5>Profile</h5>
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
                        <label class="col-form-label pt-3" for="foto_profil">Foto Profil</label>
                        <input class="form-control" id="foto_profil" name="foto_profil" type="file">
                    </div>
                    <div class="col-md-8">
                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label" for="email">Email</label>
                            <div class="col-md-8">
                                <input value="{{ auth()->user()->role->name == 'reseller' ? auth()->user()->email : old('email') }}" class="form-control" id="email" type="email" disabled>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label" for="nama">Nama</label>
                            <div class="col-md-8">
                                <input value="{{ auth()->user()->role->name == 'reseller' ? auth()->user()->reseller->nama : old('nama') }}" class="form-control" id="nama" name="nama" type="text">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label" for="no_hp">No Handphone</label>
                            <div class="col-md-8">
                                <input value="{{ auth()->user()->role->name == 'reseller' ? auth()->user()->reseller->no_hp : old('no_hp') }}" class="form-control" id="no_hp" name="no_hp" type="text">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label" for="provinsi">Provinsi</label>
                            <div class="col-md-8">
                                <input value="{{ auth()->user()->role->name == 'reseller' ? auth()->user()->reseller->provinsi : old('provinsi') }}" class="form-control" id="provinsi" name="provinsi" type="text">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label" for="kota">Kota</label>
                            <div class="col-md-8">
                                <input value="{{ auth()->user()->role->name == 'reseller' ? auth()->user()->reseller->kota : old('kota') }}" class="form-control" id="kota" name="kota" type="text">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label" for="kecamatan">Kecamatan</label>
                            <div class="col-md-8">
                                <input value="{{ auth()->user()->role->name == 'reseller' ? auth()->user()->reseller->kecamatan : old('kecamatan') }}" class="form-control" id="kecamatan" name="kecamatan" type="text">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label" for="alamat_detail">Alamat Detail</label>
                            <div class="col-md-8">
                                <input value="{{ auth()->user()->role->name == 'reseller' ? auth()->user()->reseller->alamat_detail : old('alamat_detail') }}" class="form-control" id="alamat_detail" name="alamat_detail" type="text">
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <button type="button" class="btn custom-button" id="btn-update-reseller">Update</button>
                            <a href="{{ route('change-password') }}" class="btn custom-button">Change Password</a>
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
        $('#btn-update-reseller').click(function () {
            var formData = new FormData($('#form-update-reseller')[0]);
            $.ajax({
                url: '/update-profile-reseller',
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
                        }).then(function() {
                            location.reload();
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
