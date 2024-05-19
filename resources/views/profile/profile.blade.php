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
    table.dataTable thead th {
        text-align: center !important;
        vertical-align: middle !important;
    }

    div.dt-scroll-body thead tr,
    div.dt-scroll-body thead th {
        border-bottom-width: 0 !important;
        border-top-width: 0 !important;
    }

    div.dt-scroll-body::-webkit-scrollbar-track {
        -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
        background-color: #F5F5F5;
    }

    div.dt-scroll-body::-webkit-scrollbar {
        width: 4px;
        background-color: #F5F5F5;
    }

    div.dt-scroll-body::-webkit-scrollbar-thumb {
        background-color: #6c757d;
    }

    .card-body,
    .card-body input,
    .card-body select,
    .card-body table,
    table {
        font-size: .8rem !important;
    }

    th {
        font-weight: 500 !important;
    }

    .datepicker {
        z-index: 1600 !important;
    }

    table.dataTable td.dt-empty {
        text-align: start;
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
    <!-- Bagian Kiri: Profile -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5>Profile</h5>
            </div>
            <div class="card-body">
                <form id="form-update-agen" class="theme-form">
                    @csrf
                    @method('put')
                    <div class="mb-3">
                        <label class="col-form-label pt-0" for="no_registration">Nomor Registrasi</label>
                        <input
                            value="{{ auth()->user()->role->name == 'agen' ? auth()->user()->agen->no_registration : old('no_registration') }}"
                            class="form-control" id="no_registrastion" type="text" aria-describedby="noRegHelp"
                            disabled>
                    </div>
                    <div class="mb-3">
                        <label class="col-form-label pt-0" for="email">Email</label>
                        <input
                            value="{{ auth()->user()->role->name == 'agen' ? auth()->user()->email : old('email') }}"
                            class="form-control" id="email" type="email" disabled>
                    </div>
                    <div class="mb-3">
                        <label class="col-form-label pt-0" for="nama_agen">Nama Perusahaan/Agen</label>
                        <input
                            value="{{ auth()->user()->role->name == 'agen' ? auth()->user()->agen->nama_agen : old('nama_agen') }}"
                            class="form-control" id="nama_agen" name="nama_agen" type="text"
                            placeholder="Masukkan Nama Terdaftar" disabled>
                    </div>
                    <div class="mb-3">
                        <label class="col-form-label pt-0" for="alamat">Alamat Perusahaan</label>
                        <input
                            value="{{ auth()->user()->role->name == 'agen' ? auth()->user()->agen->alamat : old('alamat') }}"
                            class="form-control" id="alamat" name="alamat" type="text"
                            placeholder="Masukkan Alamat Terdaftar">
                    </div>
                    <div class="mb-3">
                        <label class="col-form-label pt-0" for="kotaOrKabupaten">Kota/Kabupaten</label>
                        <input
                            value="{{ auth()->user()->role->name == 'agen' ? auth()->user()->agen->kotaOrKabupaten : old('kotaOrKabupaten') }}"
                            class="form-control" id="kotaOrKabupaten" name="kotaOrKabupaten" type="text"
                            placeholder="Masukkan Kota Terdaftar">
                    </div>
                    <div class="mb-3">
                        <label class="col-form-label pt-0" for="no_telp">No.Telepon/Handphone</label>
                        <input
                            value="{{ auth()->user()->role->name == 'agen' ? auth()->user()->agen->no_telp : old('no_telp') }}"
                            class="form-control" id="no_telp" name="no_telp" type="number"
                            placeholder="Masukkan No.Telepon Terdaftar">
                    </div>
                    <div class="mb-3">
                        <label class="col-form-label pt-0" for="nama_pimpinan_perusahaan">Nama Pimpinan
                            Perusahaan</label>
                        <input
                            value="{{ auth()->user()->role->name == 'agen' ? auth()->user()->agen->nama_pimpinan_perusahaan : old('nama_pimpinan_perusahaan') }}"
                            class="form-control" id="nama_pimpinan_perusahaan" name="nama_pimpinan_perusahaan"
                            type="text" placeholder="Masukkan Nama Pimpinan Perusahaan">
                    </div>
                    <div class="mb-3">
                        <label class="col-form-label pt-0" for="no_hp_pimpinan_perusahaan">No.Handphone Pimpinan
                            Perusahaan</label>
                        <input
                            value="{{ auth()->user()->role->name == 'agen' ? auth()->user()->agen->no_hp_pimpinan_perusahaan : old('no_hp_pimpinan_perusahaan') }}"
                            class="form-control" id="no_hp_pimpinan_perusahaan" name="no_hp_pimpinan_perusahaan"
                            type="number" placeholder="Masukkan No.Handphone Pimpinan Perusahaan">
                    </div>
                    <div class="card-footer text-end">
                        <button type="button" class="btn btn-secondary" id="btn-update-agen">Update</button>
                    </div>
                </form>
            </div>
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
        $('#btn-update-agen').click(function () {
            // Mengumpulkan data formulir
            var formData = $('#form-update-agen').serialize();

            $.ajax({
                url: '/profile',
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function (response) {
                    // Menangani respons dari server
                    if (response.status) {
                        // Jika berhasil, tampilkan pesan sukses
                        Swal.fire({
                            title: 'Berhasil',
                            text: response.message,
                            icon: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        })
                    } else {
                        // Jika gagal, tampilkan pesan error
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
                    // Menangani kesalahan AJAX
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