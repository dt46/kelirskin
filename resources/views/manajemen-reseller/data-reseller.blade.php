@extends('layouts.simple.master')
@section('title', 'Daftar Reseller')

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

    #tabel-daftar-reseller th,
    #tabel-daftar-reseller td {
        text-align: center;
        vertical-align: middle;
    }
</style>
@endsection

@section('breadcrumb-title')
<h3>Daftar Reseller</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item active">Daftar Reseller</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Daftar Reseller</h5>
                </div>
                <div class="card-body"> 
                    <div class="d-flex justify-content-between mb-4">
                        <div>
                            <input type="text" class="form-control form-control-sm" id="search" placeholder="Search">
                        </div>
                        <div>
                            <button class="btn btn-sm btn-info px-3" style="color: white;" id="btn-tambah-keberangkatan" type="button"
                                data-bs-toggle="modal" data-bs-target=".tambah-data-keberangkatan">Ubah Data
                            </button>
                            <button class="btn btn-sm btn-danger px-3" id="btn-verify" type="button">Hapus Data
                            </button>
                        </div>
                    </div>
                    <table id="tabel-daftar-reseller" class="nowrap table table-striped table-bordered border-secondary">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Nama Pengguna</th>
                                <th>Email</th>
                                <th>No. WhatsApp</th>
                                <th>Alamat</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Tambah Data --}}
<div class="modal fade bd-example-modal-lg tambah-data-keberangkatan" id="addData" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Tambah Data Keberangkatan</h4>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row" id="form-keberangkatan">
                    @csrf
                    @method('POST')
                    <div class="col-12 col-lg-6">
                        <div class="mb-3">
                            <label class="col-form-label">Nama Kapal</label>
                            <input class="form-control" type="text" name="nama_kapal" placeholder="Masukan Nama Kapal"
                                required>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Pelabuhan Tujuan</label>
                            <input class="form-control" type="text" name="pelabuhan_tujuan"
                                placeholder="Masukan Pelabuhan Tujuan" required>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-12 col-xl-6">
                                <label class="col-form-label">Rencana Tanggal Berangkat</label>
                                <div class="input-group">
                                    <input class="datepicker-here form-control digits" id="rencana_tanggal_berangkat"
                                        type="text" data-language="en" data-position="top left"
                                        placeholder="Masukkan Rencana Tanggal" required autocomplete="off"
                                        name="rencana_tanggal_berangkat">
                                </div>
                            </div>
                            <div class="mb-3 col-12 col-xl-6">
                                <label class="col-form-label">Jumlah Awak</label>
                                <input class="form-control" type="number" name="jumlah_awak"
                                    placeholder="Masukan Jumlah Awak" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="mb-3">
                            <label class="col-form-label">Unggah Berkas (.png, .jpg, .jpeg, .pdf)</label>
                            <div class="border rounded-3 p-3">
                                <button class="btn btn-primary btn-sm py-1 px-3 mb-3" id="tambah-input-file">
                                    <i class="fa fa-plus"></i>
                                    <span>Tambah Input File</span>
                                </button>
                                <div class="box-docs d-flex flex-column gap-2">
                                    <div class="items-input-file d-flex gap-2">
                                        <input class="form-control form-control-sm" type="file"
                                            accept=".png,.jpg,.jpeg,.pdf" required name="berkas_keberangkatan[]">
                                        <button class="btn-del-input-file btn btn-danger btn-sm py-0 px-3"
                                            type="button">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="batal-form-keberangkatan"
                    data-bs-dismiss="modal">Batalkan</button>
                <button type="submit" id="simpan-form-keberangkatan" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>
{{-- Tambah Berkas --}}
<div class="modal fade unggah-file-keberangkatan" id="fileModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel2">Dokumen Keberangkatan</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="mb-2">
                            <button class="btn btn-primary btn-sm px-3" id="btn-input-unggah-berkas">
                                <i class="fa fa-plus"></i>
                                <span>Tambah Berkas</span>
                            </button>
                            <form id="form-unggah-berkas" class="d-none">
                                @csrf
                                @method("POST")
                                <input type="file" accept=".png, .jpg, .jpeg, .pdf" name="berkas_keberangkatan">
                            </form>
                        </div>
                        <table id="tabel-berkas-keberangkatan"
                            class="nowrap table table-striped table-bordered border-secondary">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>NAMA FILE</th>
                                    <th>TANGGAL</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer modal-footer-tambah-berkas-data-keberangkatan">
                <button class="btn btn-danger" type="button" id="close-form-berkas-keberangkatan"
                    data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="/assets/js/tom-select/tom-select.complete.min.js"></script>
<script src="/assets/js/datatable/dataTables.min.js"></script>
<script src="/assets/js/datatable/datatable-extension/dataTables.buttons.min.js"></script>
<script src="/assets/js/datatable/datatable-extension/dataTables.fixedColumns.min.js"></script>
<script src="/assets/js/datatable/datatable-extension/jszip.min.js"></script>
<script src="/assets/js/datatable/datatable-extension/buttons.html5.min.js"></script>
<script src="/assets/js/datepicker/date-picker/datepicker.js"></script>
<script src="/assets/js/datepicker/date-picker/datepicker.en.js"></script>
<script src="/assets/js/datepicker/date-picker/datepicker.custom.js"></script>
<script src="/assets/js/sweet-alert/sweetalert2.all.min.js"></script>
<script src="/assets/js/height-equal.js"></script>

<script>
    const toggleStatusBtn = (val, ...selectors)=>{
        let elements = $();
        selectors.forEach(selector => {
            elements = elements.add($(selector));
        });
        elements.prop('disabled', val);
    }

    const tomSelectOptions = {
        create: true,
        sortField: {
            field: "text",
            direction: "asc"
        }
    };

    let tomBenderaKapal = null;
    if ($("#tom-bendera-kapal").length) tomBenderaKapal = new TomSelect("#tom-bendera-kapal", tomSelectOptions);
    let tomTambahManifest = null;
    if ($("#tom-tambah-manifest").length) tomTambahManifest = new TomSelect("#tom-tambah-manifest", tomSelectOptions);
    let tomUbahManifest = null;
    if ($("#tom-ubah-manifest").length) tomUbahManifest = new TomSelect("#tom-ubah-manifest", tomSelectOptions);
</script>
<script>
    (function(){
        const tableReseller = new DataTable('#tabel-daftar-reseller', {
            fixedColumns: true,
            scrollX: true,
            dom: 'Bfrtip',
            searching: false, 
            buttons: [],
            ajax: {
                url: '/daftar-reseller',
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
                    },
                    className: 'text-center'
                },
                { data: 'nama' },
                { data: 'email' },
                { data: 'no_hp' },
                { data: 'alamat_detail' },
                { 
                    data: 'status',
                    render: function (data, type, row) {
                        if (data == 'true' || data == 1) {
                            return '<button class="btn btn-success btn-sm" disabled>Aktif</button>';
                        } else {
                            return '<button class="btn btn-danger btn-sm" disabled>Nonaktif</button>';
                        }
                    },
                    className: 'text-center'
                },
            ],
            columnDefs: [
                {
                    visible: false,
                },
            ]
        });


        $('#search').on('keyup', function () {
            tableReseller.search(this.value).draw();
        });
        
        // Event listener untuk menangani peristiwa saat baris dipilih
        $('#tabel-daftar-reseller tbody').on('click', 'tr', function () {
            if ($(this).hasClass('selected')) {
                $(this).removeClass('selected');
                // Menyembunyikan tombol ubah dan hapus saat tidak ada baris yang dipilih
                $('#btn-tambah-keberangkatan, #btn-verify').prop('disabled', true);
            } else {
                tableReseller.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
                // Menampilkan tombol ubah dan hapus saat ada baris yang dipilih
                $('#btn-tambah-keberangkatan, #btn-verify').prop('disabled', false);
            }
        });

        // Fungsi untuk menghapus data
        $('#btn-verify').on('click', function() {
            const selectedRowData = tableReseller.row('.selected').data();
            if(selectedRowData){
                // Lakukan proses penghapusan data di sini menggunakan AJAX atau metode lainnya
                // Tambahkan kode untuk menangani penghapusan data
                // Setelah penghapusan berhasil, Anda bisa melakukan reload tabel atau tindakan lainnya
                console.log('Data yang dipilih untuk dihapus:', selectedRowData);
            }
        });

        // Fungsi untuk mengubah data
        $('#btn-tambah-keberangkatan').on('click', function() {
            const selectedRowData = tableReseller.row('.selected').data();
            if(selectedRowData){
                // Lakukan proses pengubahan data di sini menggunakan AJAX atau metode lainnya
                // Tambahkan kode untuk menangani pengubahan data
                console.log('Data yang dipilih untuk diubah:', selectedRowData);
            }
        });
        // Memfilter Data ketika ada input yang dimasukan / atau berubah
        $(`#filter-from,
           #filter-to,
           #filter-status,
           #filter-keyword,
           #filter-value`)
           .change(function(){
            let from = $('#filter-from').val();
            let to = $('#filter-to').val();
            let status = $('#filter-status').val();
            let keyword = $('#filter-keyword').val();
            let value = $('#filter-value').val();

            if (keyword == 'created_at' || keyword == 'rencana_tanggal_berangkat'){
                $('#value').attr('type', 'date');
            }
            else if (keyword == 'jumlah_awak') {
                $('#value').attr('type', 'number');
            }
            else {
                $('#value').attr('type', 'text');
            }

            tableReseller.ajax.url(`/pelaporan-keberangkatan?&from=${from}&to=${to}&status=${status}&${keyword}=${value}`).load();
        });

        // =========================== tambah keberangkatan agen
        $('#tambah-input-file').off('click').on('click', function() {
            const inputFile = `<div class="items-input-file d-flex gap-2">
                                <input class="form-control form-control-sm" type="file" accept=".png,.jpg,.jpeg,.pdf" name="berkas_kedatangan[]" required>
                                <button class="btn-del-input-file btn btn-danger btn-sm py-0 px-3" type="button">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>`;
            $('.box-docs').append(inputFile);
        });

        // Menghapus input file ketika menekan tombol hapus
        $(document).off('click', 'button.btn-del-input-file').on('click', 'button.btn-del-input-file', function() {
            $(this).parent('.items-input-file').remove();
        });

        $('button#simpan-form-keberangkatan').off('click').on('click', function(){
            $('form#form-keberangkatan').submit();
        });

        // Tambah keberangkatan agen
        $('#form-keberangkatan').submit(function(e){
            e.preventDefault();

            if (!this.checkValidity()) {
                e.stopPropagation();
            } else {
                let data = new FormData(this);
                toggleStatusBtn(true, '#simpan-form-keberangkatan', '#batal-form-keberangkatan');
                $.ajax({
                    url: '/pelaporan-keberangkatan',
                    type: 'POST',
                    data: data,
                    contentType: false,
                    processData: false,
                    success: function(){
                        console.log("Berhasil");
                        $('#addData').modal('hide');
                        $('.form-control').val('');
                        tableReseller.ajax.reload();

                        Swal.fire({
                            title: "Berhasil!!!",
                            text: "Data Keberangkatan Berhasil Disimpan",
                            position: "top-end",
                            showConfirmButton: false,
                            icon: "success",
                            timer: 2000
                        });
                    },
                    error: function(error){
                        console.error(error);
                    },
                    complete: function(data) {
                        toggleStatusBtn(false, '#simpan-form-keberangkatan', '#batal-form-keberangkatan');
                    }
                });
            }
            this.classList.add('was-validated');
        });

        $('.modal.tambah-data-keberangkatan').on('hidden.bs.modal', function() {
            $('form#form-keberangkatan').removeClass('was-validated');
            $('form#form-keberangkatan').trigger("reset");
            tomBenderaKapal.clear();

            $('.items-input-file:not(:first)').remove();
        });

        // =========================== tambah berkas keberangkatan agen
        let deperatureIdFromBtnUnggahFile = null;
        $('#tabel-keberangkatan').on('click', '#button-unggah-file', function() {
            deperatureIdFromBtnUnggahFile = $(this).data('id');

            toggleStatusBtn(true, 'button#button-unggah-file', '#btn-tambah-keberangkatan',);
            const tableTambahBerkas = new DataTable('#tabel-berkas-keberangkatan', {
                scrollX: true,
                lengthChange: false,
                paging: false,
                info: false,
                ajax: {
                    url: `/pelaporan-keberangkatan/file/${deperatureIdFromBtnUnggahFile}`,
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
                    {
                        data: "nama_file",
                        render: function (data, type, row) {
                            return `<a href="${data}" target="_blank">${row.nama_file_original}</a>`;
                        }
                    },
                    { data: 'tanggal' },
                ],
                initComplete: function (settings, json) {
                    modalAddFile.show();
                    toggleStatusBtn(false, 'button#button-unggah-file', '#btn-tambah-keberangkatan',);
                }
            });

            $('#btn-input-unggah-berkas').off('click').on('click', function() {
                $('form#form-unggah-berkas input[type="file"]').click();
            });

            $('form#form-unggah-berkas input[type="file"]').off('change').on('change', function() {
                if (this.files && this.files[0]) {
                    let formData = new FormData($(this).closest('form')[0]);
                    formData.append('deperature_id', deperatureIdFromBtnUnggahFile);

                    toggleStatusBtn(true, '#btn-input-unggah-berkas', '.modal.unggah-file-keberangkatan .modal-footer button');
                    $.ajax({
                        url: '/pelaporan-keberangkatan/file',
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            let _msgTitle = response.status ? 'Berhasil' : 'Gagal';
                            let _msg = response.status ? 'Berkas keberangkatan Berhasil Disimpan' : 'Gagal menyimpan berkas, terdapat kesalahan sistem.';
                            let _icon = response.status ? 'success' : 'error';

                            Swal.fire({
                                title: _msgTitle,
                                text: _msg,
                                position: "top-end",
                                showConfirmButton: false,
                                icon: _icon,
                                timer: 2000
                            });

                            tableTambahBerkas.ajax.reload();
                        },
                        error: function(jqXHR, textStatus, errorMessage) {
                            console.log(errorMessage)
                        },
                        complete: function(data){
                            toggleStatusBtn(false, '#btn-input-unggah-berkas', '.modal.unggah-file-keberangkatan .modal-footer button');
                        }
                    });
                }
                $(this).val('');
            });
        });

        $('.unggah-file-keberangkatan').on('hidden.bs.modal', function() {
            $('#tabel-berkas-keberangkatan').DataTable().destroy();
            deperatureIdFromBtnUnggahFile = null;
        });

    })();
</script>

@endsection