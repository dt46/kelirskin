@extends('layouts.simple.master')
@section('title', 'Default Forms')

@section('css')
@endsection

@section('style')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/jsgrid.css')}}">
@endsection

@section('breadcrumb-title')
<h3>Profile Perusahaan/Agen</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item active">Profile</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Bagian Kiri: Profile -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Profile</h5>
                </div>
                <div class="card-body">
                    <form class="theme-form">
						<div class="mb-3">
							<label class="col-form-label pt-0" for="exampleInputNoReg">Nomor Registrasi</label>
							<input class="form-control" id="exampleInputNoReg" type="text" aria-describedby="noRegHelp" placeholder="Masukkan No Reg Terdaftar">
						</div>
						<div class="mb-3">
							<label class="col-form-label pt-0" for="exampleInputEmail">Email</label>
							<input class="form-control" id="exampleInputEmail" type="email" placeholder="Masukkan Email Terdaftar">
						</div>
						<div class="mb-3">
							<label class="col-form-label pt-0" for="exampleInputnamaAgen">Nama Perusahaan/Agen</label>
							<input class="form-control" id="exampleInputnamaAgen" type="text" placeholder="Masukkan Nama Terdaftar">
						</div>
						<div class="mb-3">
							<label class="col-form-label pt-0" for="exampleInputAlamat">Alamat Perusahaan</label>
							<input class="form-control" id="exampleInputnamaAlamat" type="text" placeholder="Masukkan Alamat Terdaftar">
						</div>
						<div class="mb-3">
							<label class="col-form-label pt-0" for="exampleInputKota">Kota/Kabupaten</label>
							<input class="form-control" id="exampleInputnamaKota" type="text" placeholder="Masukkan Kota Terdaftar">
						</div>
						<div class="mb-3">
							<label class="col-form-label pt-0" for="exampleInputNoHp">No.Telepon/Handphone</label>
							<input class="form-control" id="exampleInputNoHp" type="number" placeholder="Masukkan No.Telepon Terdaftar">
						</div>
						<div class="mb-3">
							<label class="col-form-label pt-0" for="exampleInputNamaPimpinan">Nama Pimpinan Perusahaan</label>
							<input class="form-control" id="exampleInputNamaPimpinan" type="text" placeholder="Masukkan Nama Pimpinan Perusahaan">
						</div>
						<div class="mb-3">
							<label class="col-form-label pt-0" for="exampleInputNoHpPimpinan">No.Handphone Pimpinan Perusahaan</label>
							<input class="form-control" id="exampleInputNoHpPimpinan" type="number" placeholder="Masukkan No.Handphone Pimpinan Perusahaan">
						</div>
                    </form>
					<div class="card-footer text-end">
						<button class="btn btn-primary">Submit</button>
						<button class="btn btn-secondary">Cancel</button>
					</div>
                </div>
            </div>
        </div>

        <!-- Bagian Kanan: Upload Dokumen Perusahaan -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Upload Dokumen Perusahaan (SIUP, NPWP, dll)</h5>
                </div>
                <div class="card-body">
                    <button class="btn btn-sm btn-secondary mb-3" id="uploadFile" type="button">Upload File</button>
                    <div class="js-shorting" id="uploadFilePerusahaan"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{asset('assets/js/jsgrid/jsgrid.min.js')}}"></script>
<script src="{{asset('assets/js/jsgrid/griddata.js')}}"></script>
<script src="{{asset('assets/js/jsgrid/jsgrid.js')}}"></script>
@endsection