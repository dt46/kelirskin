@extends('layouts.simple.master')
@section('title', 'Tambah Produk')

@section('css')

@endsection

@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/date-picker.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/dropzone.css')}}">
@endsection

@section('breadcrumb-title')
<h3>Tambah Produk</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Produk</li>
<li class="breadcrumb-item active">Tambah Produk</li>
@endsection

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-body">
        @if (session('res-status'))
          <div class="alert alert-{{ session('res-status')['status'] }}">
              {{ session('res-status')['msg'] }}
          </div>
        @endif
          <form action="{{ route('tambah-produk') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form theme-form">
              <div class="row">
                <div class="col">
                  <div class="mb-3">
                    <label for="namaProduk">Nama Produk</label>
                    <input id="namaProduk" name="namaProduk" class="form-control" type="text" placeholder="Nama Produk *">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="mb-3">
                    <label for="fotoProduk">Foto Produk</label>
                    <input id="fotoProduk" name="fotoProduk" class="form-control" type="file" accept="image/*">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <div class="mb-3">
                    <label for="hargaProduk">Harga Produk</label>
                    <input id="hargaProduk" name="hargaProduk" class="form-control" type="text" placeholder="Harga Produk">
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="mb-3">
                    <label for="stokProduk">Stok Produk</label>
                    <input id="stokProduk" name="stokProduk" class="form-control" type="text" placeholder="Stok Produk">
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="mb-3">
                    <label for="beratProduk">Berat Produk (ml)</label>
                    <input id="beratProduk" name="beratProduk" class="form-control" type="text" placeholder="Berat Produk">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="mb-3">
                    <label for="deskripsiProduk">Deskripsi Produk</label>
                    <textarea id="deskripsiProduk" name="deskripsiProduk" class="form-control" rows="3" placeholder="Deskripsi Produk"></textarea>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="mb-3">
                      <label for="kategoriProduk">Kategori Produk</label>
                      <select id="kategoriProduk" name="kategoriProduk" class="form-control">
                          <option value="" disabled selected>Pilih Kategori Produk</option>
                          <option value="serum">Serum</option>
                          <option value="facewash">Face Wash</option>
                          <option value="facecream">Face Cream</option>
                          <option value="toner">Toner & Micellar Water</option>
                      </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <button type="submit" class="btn btn-success me-3">Simpan</button>
                  <a href="#" class="btn btn-danger">Batal</a>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
<script src="{{asset('assets/js/datepicker/date-picker/datepicker.js')}}"></script>
<script src="{{asset('assets/js/datepicker/date-picker/datepicker.en.js')}}"></script>
<script src="{{asset('assets/js/datepicker/date-picker/datepicker.custom.js')}}"></script>
<script src="{{asset('assets/js/dropzone/dropzone.js')}}"></script>
<script src="{{asset('assets/js/dropzone/dropzone-script.js')}}"></script>
<script src="{{asset('assets/js/typeahead/handlebars.js')}}"></script>
@endsection
