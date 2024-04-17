@extends('layouts.simple.master')
@section('title', 'JS Grid Tables')

@section('css')

@endsection

@section('style')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/jsgrid/jsgrid.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/jsgrid/jsgrid-theme.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/select2.css')}}">
@endsection

@section('breadcrumb-title')
<h3>JS Grid Tables</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Tables</li>
<li class="breadcrumb-item active">JS Grid Tables</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Data Kedatangan</h5>
                </div>
                <div class="card-body">
                    <div class="sort-panel mb-3 d-flex flex-row">
                        <div>
                            <label class="form-label" for="exampleFormControlInput1">Periode Tgl.Datang</label>
                            <input class="form-control" id="exampleFormControlInput1" type="date" style="width: 150px;">
                        </div>
                        <div class="ms-3">
                            <!-- ms-3 untuk memberikan margin kiri antar elemen -->
                            <label class="form-label" for="exampleFormControlInput2">s.d</label>
                            <input class="form-control" id="exampleFormControlInput2" type="date" style="width: 150px;">
                        </div>
                        <div class="ms-3" style="width: 190px;">
                            <label class="form-label" for="exampleSelect">Status</label>
                            <select class="form-select" id="exampleSelect">
                                <option selected>Semua</option>
                                <option value="1">Sudah Verifikasi</option>
                                <option value="2">Belum Verifikasi</option>
                            </select>
                        </div>
                        <div class="ms-3" style="width: 130px;">
                            <label class="form-label" for="exampleSelect">Kata Kunci</label>
                            <select class="form-select" id="exampleSelect">
                                <option selected>No.Agenda</option>
                                <option value="1">Sudah Verifikasi</option>
                                <option value="2">Belum Verifikasi</option>
                            </select>
                        </div>
                        <div class="mt-1" style="width: 280px;">
                            <div>
                                <label class="form-label" for="exampleFormControlInput3"></label>
                                <input class="form-control" id="exampleFormControlInput3" type="text">
                            </div>
                        </div>
                    </div>
                    <div class="sort-panel mb-3">
                        <div class="d-inline">
                            <button class="btn btn-sm btn-secondary" id="sort" type="button">Tambah Data</button>
                            <button class="btn btn-sm btn-success" id="sort" type="button">Export</button>
                        </div>
                    </div>
                    <div class="js-shorting" id="sorting-table"></div>
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
<script src="{{asset('assets/js/select2/select2.full.min.js')}}"></script>
<script src="{{asset('assets/js/select2/select2-custom.js')}}"></script>
@endsection