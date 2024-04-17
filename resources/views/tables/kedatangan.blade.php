@extends('layouts.simple.master')
@section('title', 'Kedatangan')

@section('css')

@endsection

@section('style')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/select2.css')}}">
<link rel="stylesheet" href="{{asset('assets/js/datatable/dataTables.dataTables.min.css')}}">
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

    div.dt-scroll-body tbody td {
        text-align: start !important;
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

    table {
        font-size: .8rem !important;
    }

    th {
        font-weight: 500 !important;
    }
</style>
@endsection

@section('breadcrumb-title')
<h3>Kedatangan</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Pelaporan</li>
<li class="breadcrumb-item active">Kedatangan</li>
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
                    <div class="sort-panel mb-4 row">
                        <div class="col-4 col-xl-2">
                            <label class="form-label" for="exampleFormControlInput1">Periode Tgl.Datang</label>
                            <input class="form-control" id="exampleFormControlInput1" type="date">
                        </div>
                        <div class="col-4 col-xl-2">
                            <label class="form-label" for="exampleFormControlInput2">s.d</label>
                            <input class="form-control" id="exampleFormControlInput2" type="date">
                        </div>
                        <div class="col-4 col-xl-3">
                            <label class="form-label" for="exampleSelect">Status</label>
                            <select class="form-select" id="exampleSelect">
                                <option selected>Semua</option>
                                <option value="1">Sudah Verifikasi</option>
                                <option value="2">Belum Verifikasi</option>
                            </select>
                        </div>
                        <div class="col-12 col-xl-5 pt-3 pt-xl-0">
                            <label class="form-label" for="exampleSelect">Kata Kunci</label>
                            <div class="d-flex">
                                <select class="form-select" id="exampleSelect" style="width: max-content;">
                                    <option selected>No.Agenda</option>
                                    <option value="1">Sudah Verifikasi</option>
                                    <option value="2">Belum Verifikasi</option>
                                </select>
                                <input class="form-control" id="exampleFormControlInput3" type="text"
                                    placeholder="Masukkan nilai...">
                            </div>
                        </div>
                    </div>
                    @if (auth()->user()->role->name == "agen")
                    <div class="sort-panel mb-4">
                        <div class="d-inline">
                            <button class="btn btn-sm btn-secondary" id="sort" type="button" data-bs-toggle="modal"
                                data-bs-target=".tambah-data-kedatangan">Tambah Data</button>
                            <button class="btn btn-sm btn-success" id="sort" type="button">Export</button>
                        </div>
                    </div>
                    <table id="tabel-kedatangan" class="nowrap table table-striped table-bordered border-secondary">
                        <thead>
                            <tr>
                                <th rowspan="2"></th>
                                <th rowspan="2">NO.AGENDA</th>
                                <th rowspan="2">TAMBAH<br />BERKAS</th>
                                <th colspan="3">VERIFIKASI</th>
                                <th rowspan="2">TANDA<br />TERIMA</th>
                                <th rowspan="2">NAMA KAPAL</th>
                                <th rowspan="2">BENDERA KAPAL</th>
                                <th rowspan="2">PELABUHAN ASAL</th>
                                <th rowspan="2">RENCANA TANGGAL<br />KEDATANGAN</th>
                                <th rowspan="2">JUMLAH AWAK<br />ALAT ANGKUT</th>
                                <th rowspan="2">RENCANA LAMA<br />BERLABUH</th>
                                <th rowspan="2">CATATAN PETUGAS</th>
                                <th rowspan="2">TANGGAL DIBUAT</th>
                            </tr>
                            <tr>
                                <th>VERIFY</th>
                                <th>NOMOR</th>
                                <th>TANGGAL</th>
                            </tr>
                        </thead>
                    </table>
                    @else
                    <div class="sort-panel mb-4">
                        <div class="d-inline">
                            <button class="btn btn-sm btn-secondary" id="sort" type="button" data-bs-toggle="modal"
                                data-bs-target=".tambah-verifikasi-data">Verifikasi Data</button>
                            <button class="btn btn-sm btn-success" id="sort" type="button">Export</button>
                        </div>
                    </div>
                    <table id="tabel-kedatanganAdminPetugas" class="nowrap table table-striped table-bordered border-secondary">
                        <thead>
                            <tr>
                                <th rowspan="2"></th>
                                <th rowspan="2">NO.AGENDA</th>
                                <th rowspan="2">MANIFEST</th>
                                <th colspan="3">VERIFIKASI</th>
                                <th rowspan="2">TANDA<br />TERIMA</th>
                                <th rowspan="2">NAMA KAPAL</th>
                                <th rowspan="2">BENDERA KAPAL</th>
                                <th rowspan="2">PELABUHAN ASAL</th>
                                <th rowspan="2">TPI</th>
                                <th rowspan="2">RENCANA TANGGAL<br />KEDATANGAN</th>
                                <th rowspan="2">JUMLAH AWAK<br />ALAT ANGKUT</th>
                                <th rowspan="2">RENCANA LAMA<br />BERLABUH</th>
                                <th rowspan="2">CATATAN PETUGAS</th>
                                <th rowspan="2">TANGGAL DIBUAT</th>
                            </tr>
                            <tr>
                                <th>VERIFY</th>
                                <th>NOMOR</th>
                                <th>TANGGAL</th>
                            </tr>
                        </thead>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@if (auth()->user()->role->name == "agen")
{{-- Tambah Data --}}
<div class="modal fade tambah-data-kedatangan" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Data Kedatangan</h4>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">...</div>
        </div>
    </div>
</div>

{{-- Tambah Berkas --}}
<div class="modal fade unggah-file-kedatangan" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Dokumen Kedatangan</h4>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">...</div>
        </div>
    </div>
</div>
@else
{{-- Tambah Data --}}
<div class="modal fade tambah-verifikasi-data" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Data Kedatangan</h4>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row" id="form-keberangkatan" action="" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="col">
                        <h6>Data Kedatangan</h6>
                        <div class="mb-3">
                            <label class="col-form-label">Nomor Agenda</label>
                            <input class="form-control" type="text" name="no_agenda" placeholder="Nomor Agenda" disabled>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Nama Kapal</label>
                            <input class="form-control" type="text" name="nama_kapal" placeholder="Masukkan Nama Kapal">
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Bendera Kapal</label>
                            <select class="form-control" name="bendera_kapal">
                                <option value="">Pilih Bendera Kapal</option>
                                <?php
                                $bendera_kapal_options = ['Bendera1', 'Bendera2', 'Bendera3']; // Ganti dengan data bendera kapal yang sesuai dari database
                                foreach ($bendera_kapal_options as $bendera_kapal_option) {
                                    echo "<option value='$bendera_kapal_option'>$bendera_kapal_option</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Pelabuhan Asal</label>
                            <input class="form-control" type="text" name="pelabuhan_asal" placeholder="Masukkan Pelabuhan Asal">
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">TPI</label>
                            <select class="form-control" name="tpi">
                                <option value="">Pilih TPI</option>
                                <?php
                                $bendera_kapal_options = ['Bendera1', 'Bendera2', 'Bendera3']; // Ganti dengan data bendera kapal yang sesuai dari database
                                foreach ($bendera_kapal_options as $bendera_kapal_option) {
                                    echo "<option value='$bendera_kapal_option'>$bendera_kapal_option</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-7">
                                <label class="form-label" for="exampleFormControlInput1">Rencana Tanggal Kedatangan</label>
                                <input class="form-control" id="exampleFormControlInput1" type="date" name="rencana_tanggal_kedatangan" placeholder="Rencana Tanggal Kedatangan">
                            </div>
                            <div class="col-5">
                                <label class="col-form-label">Jumlah Awak</label>
                                <input class="form-control" type="number" name="jumlah_awak" placeholder="Masukan Jumlah Awak">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Rencana Lama Berlabuh</label>
                            <input class="form-control" type="number" name="rencana_lama_berlabuh" placeholder="Masukan Rencana Lama Berlabuh">
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Catatan Petugas</label>
                            <textarea class="form-control" name="catatan_petugas" placeholder="Masukkan Catatan Petugas"></textarea>
                        </div>
                    </div>
                    <div class="col">
                        <h6>DOKUMEN FILE</h6>
                        <button class="btn btn-danger mb-3" id="addNewInputFile"><i class="fa fa-plus-circle"></i>Hapus</button>
                        <table id="tabel_hapus_file" class="nowrap table table-striped table-bordered border-secondary">
                            <thead>
                                <tr>
                                    <th rowspan="2"></th>
                                    <th rowspan="2">NAMA FILE</th>
                                    <th rowspan="2">TANGGAL</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" form="form-keberangkatan" class="btn btn-success">Verifikasi</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

{{-- Tambah Berkas --}}
<div class="modal fade unggah-file-kedatangan" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Dokumen Kedatangan</h4>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">...</div>
        </div>
    </div>
</div>
@endif
@endsection

@section('script')
<script src="{{asset('assets/js/select2/select2.full.min.js')}}"></script>
<script src="{{asset('assets/js/select2/select2-custom.js')}}"></script>
<script src="{{asset('assets/js/datatable/dataTables.min.js')}}"></script>

@if (auth()->user()->role->name == "agen")
<script>
    (function(){
        $.get('/pelaporan-kedatangan', function(data){
            console.log(data)
        });

        const table = new DataTable('#tabel-kedatangan', {
            scrollX: true,
            ajax: {
                url: '/pelaporan-kedatangan',
                type: 'GET',
                dataSrc: function (json) {
                    return json.data;
                }
            },
            columns: [
                {
                    data: null,
                    render: function (data, type, row, meta) {
                        return meta.row + 1;
                    }
                },
                { data: 'no_agenda' },
                {
                    data: null,
                    render: function (data, type, row) {
                        return `<button class="btn btn-primary py-1 px-3" type="button" data-bs-toggle="modal" data-bs-target=".unggah-file-kedatangan">
                                    <i class="fa fa-file-o"></i>
                                </button>`;
                    }
                },
                { data: 'v_verify' },
                { data: 'v_nomer' },
                { data: 'v_tanggal' },
                {
                    data: null,
                    render: function (data, type, row) {
                        return `<button class="btn btn-danger py-1 px-3"><i class="fa fa-file-pdf-o"></i></button>`;
                    }
                },
                { data: 'nama_kapal' },
                { data: 'bendera_kapal' },
                { data: 'pelabuhan_asal' },
                { data: 'rencana_tanggal_datang' },
                { data: 'jumlah_awak' },
                { data: 'rencana_lama_berlabuh' },
                { data: 'catatan_petugas' },
                { data: 'created_at' },
            ]
        });
    })();
</script>
@else
<script>
    (function(){
        $.get('/pelaporan-kedatangan', function(data){
            console.log(data)
        });

        const table = new DataTable('#tabel-kedatanganAdminPetugas', {
            scrollX: true,
            ajax: {
                url: '/pelaporan-kedatangan',
                type: 'GET',
                dataSrc: function (json) {
                    return json.data;
                }
            },
            columns: [
                {
                    data: null,
                    render: function (data, type, row, meta) {
                        return meta.row + 1;
                    }
                },
                { data: 'no_agenda' },
                {
                    data: null,
                    render: function (data, type, row) {
                        return `<button class="btn btn-primary py-1 px-3" type="button" data-bs-toggle="modal" data-bs-target=".unggah-file-kedatangan">
                                    <i class="fa fa-file-o"></i>
                                </button>`;
                    }
                },
                { data: 'v_verify' },
                { data: 'v_nomer' },
                { data: 'v_tanggal' },
                {
                    data: null,
                    render: function (data, type, row) {
                        return `<button class="btn btn-danger py-1 px-3"><i class="fa fa-file-pdf-o"></i></button>`;
                    }
                },
                { data: 'nama_kapal' },
                { data: 'bendera_kapal' },
                { data: 'pelabuhan_asal' },
                { data: 'tpi_id'},
                { data: 'rencana_tanggal_datang' },
                { data: 'jumlah_awak' },
                { data: 'rencana_lama_berlabuh' },
                { data: 'catatan_petugas' },
                { data: 'created_at' },
            ]
        });
    })();
</script>
@endif
<script>
    (function(){
        $.get('/pelaporan-kedatangan', function(data){
            console.log(data)
        });

        const table = new DataTable('#tabel_hapus_file', {
            scrollX: true,
            ajax: {
                url: '/pelaporan-kedatangan',
                type: 'GET',
                dataSrc: function (json) {
                    return json.data;
                }
            },
            columns: [
                {
                    data: null,
                    render: function (data, type, row, meta) {
                        return meta.row + 1;
                    }
                },
                { data: 'arrival_documents' },
                { data: 'created_at' },
            ]
        });
    })();
</script>

{{-- <script src="{{asset('assets/js/jsgrid/jsgrid.min.js')}}"></script>
<script src="{{asset('assets/js/jsgrid/griddata.js')}}"></script> --}}
{{-- <script src="{{asset('assets/js/jsgrid/jsgrid.js')}}"></script> --}}
@if (auth()->user()->role->name == "agen")
{{-- <script lang="javascript">
    $(function() {
        $("#tabel-kedatangan").jsGrid({
            height: "750px",
            width: "100%",
            autoload: true,
            sorting: true,
            selecting: false,
            paging: true,
            controller: db,
            fields: [
                { name: "", type: "number", width: 40 },
                { name: "NO.AGENDA", type: "text", width: 120 },
                {
                    name: "ADD FILE",
                    css: "text-center", 
                    itemTemplate: function (value, item) {
                        var $modal = $("#uploadModal");
                        var $fileInput = $("<input>").attr("type", "file").hide();
                        var $button = $(`<button type="button" class="btn btn-primary py-1 px-3">`)
                            .html(`<i class="fa fa-file-o"></i>`)
                            .on("click", function () {
                                $modal.modal("show");
                            });

                        $fileInput.on("change", function (e) {
                            var file = e.target.files[0];
                            // Lakukan apa pun yang perlu dilakukan dengan file yang diunggah
                            console.log("File yang diunggah:", file);
                        });

                        $modal.find("form").on("submit", function (e) {
                            e.preventhefault();
                            var formData = new FormData($(this)[0]);
                            $.ajax({
                                url: "path/to/upload/endpoint",
                                type: "POST",
                                data: formData,
                                processData: false,
                                contentType: false,
                                success: function (response) {
                                    // Handle response dari server setelah pengunggahan berhasil
                                    console.log("Upload berhasil:", response);
                                },
                                error: function (xhr, status, error) {
                                    // Handle error jika pengunggahan gagal
                                    console.error("Upload gagal:", error);
                                },
                            });
                        });

                        return $("<div>").append($fileInput, $button);
                    },
                    width: 115,
                },
                { name: "VERIFY", type: "checkbox", width: 95 },
                { name: "NOMOR", type: "text", width: 130 },
                { name: "TANGGAL", type: "number", width: 150 },
                {
                    name: "TANDA TERIMA",
                    css: "text-center",
                    itemTemplate: function (value, item) {
                        var $fileInput = $("<input>").attr("type", "file").hide();
                        var $button = $(`<button type="button" class="btn btn-danger py-1 px-3">`)
                            .html(`<i class="fa fa-file-pdf-o"></i>`)
                            .on("click", function () {
                                $fileInput.click();
                            });

                        $fileInput.on("change", function (e) {
                            var file = e.target.files[0];
                            // Lakukan konversi ke PDF di sini
                            convertToPDF(file);
                        });

                        function convertToPDF(file) {
                            // Lakukan konversi ke PDF di sini
                            // Misalnya, Anda bisa menggunakan library JavaScript untuk mengonversi file ke PDF
                            console.log("Mengonversi ke PDF:", file);
                        }

                        return $("<div>").append($fileInput, $button);
                    },
                    width: 115,
                },
                { name: "NAMA KAPAL", type: "text", width: 130 },
                { name: "BENDERA KAPAL", type: "text", width: 130 },
                { name: "PELABUHAN ASAL", type: "text", width: 130 },
                { name: "RENCANA TANGGAL KEDATANGAN", type: "date", width: 150 },
                { name: "JUMLAH AWAK ALAT ANGKUT", type: "number", width: 150 },
                { name: "RENCANA LAMA BERLABUH", type: "text", width: 150 },
                { name: "CATATAN PETUGAS", type: "text", width: 230 },
                { name: "TANGGAL DIBUAT", type: "date", width: 150 },
            ],
        });

    });
</script> --}}
@else
{{-- <script lang="javascript">
    $(function() {
        $("#tabel-kedatanganAdminPetugas").jsGrid({
            height: "750px",
            width: "100%",
            autoload: true,
            sorting: true,
            selecting: true,
            paging: true,
            controller: db,
            fields: [
                { name: "", type: "number", width: 40 },
                { name: "NO.AGENDA", type: "text", width: 120 },
                {
                    name: "MANIFEST",
                    css: "text-center", 
                    itemTemplate: function (value, item) {
                         if (value) {
                            var $modal = $("#uploadModal");
                            var $fileInput = $("<input>").attr("type", "file").hide();
                            var $button = $(`<button type="button" class="btn btn-primary py-1 px-3">`)
                                .html(`<i class="fa fa-file-o"></i>`)
                                .on("click", function () {
                                    $modal.modal("show");
                                });

                            $fileInput.on("change", function (e) {
                                var file = e.target.files[0];
                                // Lakukan apa pun yang perlu dilakukan dengan file yang diunggah
                                console.log("File yang diunggah:", file);
                            });

                            $modal.find("form").on("submit", function (e) {
                                e.preventhefault();
                                var formData = new FormData($(this)[0]);
                                $.ajax({
                                    url: "path/to/upload/endpoint",
                                    type: "POST",
                                    data: formData,
                                    processData: false,
                                    contentType: false,
                                    success: function (response) {
                                        // Handle response dari server setelah pengunggahan berhasil
                                        console.log("Upload berhasil:", response);
                                    },
                                    error: function (xhr, status, error) {
                                        // Handle error jika pengunggahan gagal
                                        console.error("Upload gagal:", error);
                                    },
                                });
                            });

                            return $("<div>").append($fileInput, $button);
                        } else {
                            return $("<span>").text(" ");
                        }
                    },
                    width: 115,
                },
                { name: "VERIFY", type: "checkbox", width: 95 },
                { name: "NOMOR", type: "text", width: 130 },
                { name: "TANGGAL", type: "number", width: 150 },
                {
                    name: "TANDA TERIMA",
                    css: "text-center",
                    itemTemplate: function (value, item) {
                        var $fileInput = $("<input>").attr("type", "file").hide();
                        var $button = $(`<button type="button" class="btn btn-danger py-1 px-3">`)
                            .html(`<i class="fa fa-file-pdf-o"></i>`)
                            .on("click", function () {
                                $fileInput.click();
                            });

                        $fileInput.on("change", function (e) {
                            var file = e.target.files[0];
                            // Lakukan konversi ke PDF di sini
                            convertToPDF(file);
                        });

                        function convertToPDF(file) {
                            // Lakukan konversi ke PDF di sini
                            // Misalnya, Anda bisa menggunakan library JavaScript untuk mengonversi file ke PDF
                            console.log("Mengonversi ke PDF:", file);
                        }

                        return $("<div>").append($fileInput, $button);
                    },
                    width: 115,
                },
                { name: "NAMA KAPAL", type: "text", width: 130 },
                { name: "BENDERA KAPAL", type: "text", width: 130 },
                { name: "PELABUHAN ASAL", type: "text", width: 130 },
                {
                    name: "TPI",
                    type: "text",
                    width: 130,
                    itemTemplate: function (value, item) {
                        if (value) {
                            return value;
                        } else {
                            return $("<span>").text("Data tidak tersedia");
                        }
                    },
                },
                { name: "RENCANA TANGGAL KEDATANGAN", type: "date", width: 150 },
                { name: "JUMLAH AWAK ALAT ANGKUT", type: "number", width: 150 },
                { name: "RENCANA LAMA BERLABUH", type: "text", width: 150 },
                { name: "CATATAN PETUGAS", type: "text", width: 230 },
                { name: "TANGGAL DIBUAT", type: "date", width: 150 },
            ],
        });

    });
</script> --}}
@endif
@endsection