@extends('layouts.simple.master')
@section('title', 'Daftar Reseller')

@section('css')

@endsection

@section('style')
<link rel="stylesheet" type="text/css" href="/assets/css/vendors/date-picker.css">
<link rel="stylesheet" type="text/css" href="/assets/css/vendors/tom-select.bootstrap5.css">
<link rel="stylesheet" type="text/css" href="/assets/css/vendors/select2.css">
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
                    <button class="btn btn-sm btn-info px-3" style="color: white;" id="ubah-data-agen" type="button">Ubah Data
                    </button>
                    <button class="btn btn-sm btn-danger px-3" id="btn-verify" type="button">Hapus Data
                    </button>
                </div>
                <div class="card-body"> 
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

{{-- Edit Data --}}
<div class="modal fade bd-example-modal-lg ubah-data-agen" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Data User Reseller</h4>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form-agen" action="" method="post">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div class="mb-3">
                                <label class="col-form-label">Nama Pengguna</label>
                                <input class="form-control" type="text" id="nama" readonly disabled>
                            </div>
                            <div class="mb-3">
                                <label class="col-form-label">Email</label>
                                <input class="form-control" type="email" id="email" readonly disabled>
                            </div>
                            <div class="mb-3">
                                <label class="col-form-label">No WhatsApp</label>
                                <input class="form-control" type="number" name="no_hp" id="no_hp" required>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="mb-3">
                                <label class="col-form-label">Alamat</label>
                                <input class="form-control" type="text" name="alamat_detail" id="alamat_detail" required>
                            </div>
                            <div class="mb-3">
                                <label class="col-form-label">Status</label>
                                <select class="form-control form-select" name="status" id="status" required>
                                    <option value="1">Aktif</option>
                                    <option value="0">Tidak Aktif</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="batal-agen"
                    data-bs-dismiss="modal">Batalkan</button>
                <button type="button" id="simpan-agen"
                    class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="/assets/js/select2/select2.full.min.js"></script>
<script src="/assets/js/select2/select2-custom.js"></script>
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
                            return '<button class="badge bg-success" disabled>Aktif</button>';
                        } else {
                            return '<button class="badge btn-danger" disabled>Nonaktif</button>';
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

        tableReseller.on('click', 'tbody tr', (e) => {
            let classList = e.currentTarget.classList;

            if (classList.contains('selected')) {
                classList.remove('selected');
            }
            else {
                tableReseller.rows('.selected').nodes().each((row) => row.classList.remove('selected'));
                classList.add('selected');
            }
        });

        const modalUbahAgen = new bootstrap.Modal(document.querySelector('.ubah-data-agen'), {
            keyboard: false
        });
        $('button#ubah-data-agen').on('click', function(){
            const idAgen = tableReseller.row('.selected').id();
            idAgen ? modalUbahAgen.show() : modalUbahAgen.hide();
        });
        $('.ubah-data-agen').on('shown.bs.modal', function() {
            idAgen = tableReseller.row('.selected').data().id;
            $.ajax({
                url: '/update-data/' + idAgen,
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response){
                    data = response.data;
                    $('#id').val(data.id);
                    $('#nama').val(data.nama);
                    $('#email').val(data.email);
                    $('#no_hp').val(data.no_hp);
                    $('#alamat_detail').val(data.alamat_detail);
                    if (data.status) {
                        $('#status').val("1"); 
                    } else {
                        $('#status').val("0");
                    }
                },
                error: function(error){
                    console.error(error);
                }
            })

            function toggleStatusBtn(disabled, buttonsSelector) {
                $(buttonsSelector).prop('disabled', disabled);
            }

            toggleStatusBtn(true, '#simpan-agen');

            $(".form-control").on('change input', function() {
                toggleStatusBtn(false, "#simpan-agen")
            });

            $('#simpan-agen').off('click').on('click', function(){
                $('#form-agen').submit();
            });

            $('#form-agen').off('submit').on('submit', function(e){
                e.preventDefault();

                toggleStatusBtn(true, '#batal-agen, #simpan-agen');

                let formData = new FormData($(this)[0]);
                let plainFormData = {};

                formData.forEach(function(value, key){
                    plainFormData[key] = value;
                });

                $.ajax({
                    url: '/update-data/' + idAgen,
                    method: 'PUT',
                    data: JSON.stringify(plainFormData),
                    contentType: 'application/json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        $('.ubah-data-agen').modal('hide');

                        let _msgTitle = response.status ? 'Berhasil' : 'Gagal';
                            let _msg = response.status ? 'Data Reseller Berhasil Diperbarui' : 'Gagal memperbarui data, terdapat kesalahan sistem.';
                            let _icon = response.status ? 'success' : 'error';

                            Swal.fire({
                                title: _msgTitle,
                                text: _msg,
                                position: "center",
                                showConfirmButton: false,
                                icon: _icon,
                                timer: 2000
                            });

                        tableReseller.ajax.reload();
                    },
                    error: function(error) {
                        console.log(error);
                    }
                }).done(function(){
                    toggleStatusBtn(false, '#batal-agen, #simpan-agen');
                });

            });
        });
    })();
</script>
@endsection