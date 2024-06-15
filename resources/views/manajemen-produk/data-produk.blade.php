@extends('layouts.simple.master')
@section('title', 'Daftar Produk')

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
<h3>Daftar Produk</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item active">Daftar Produk</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5>Daftar Produk</h5>
                        <div>
                            <button class="btn btn-sm btn-info px-3" style="color: white;" id="ubah-data-produk" type="button">Ubah Data
                            </button>
                            <button class="btn btn-sm btn-danger px-3" id="hapus-data-produk" type="button">Hapus Data
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table id="tabel-daftar-produk" class="nowrap table table-striped table-bordered border-secondary">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Nama Produk</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Berat</th>
                                <th>Kategori Produk</th>
                                <th>Deskripsi Produk</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Data Produk Modal -->
<div class="modal fade bd-example-modal-lg ubah-data-produk" tabindex="-1" role="dialog" aria-labelledby="editProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="editProductModalLabel">Edit Data Produk</h4>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form-produk" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div class="mb-3">
                                <label class="col-form-label">Nama Produk</label>
                                <input class="form-control" type="text" name="namaProduk" id="namaProduk" required>
                            </div>
                            <div class="mb-3">
                                <label class="col-form-label">Harga Produk (Rp)</label>
                                <input class="form-control" type="number" name="hargaProduk" id="hargaProduk" required>
                            </div>
                            <div class="mb-3">
                                <label class="col-form-label">Stok Produk</label>
                                <input class="form-control" type="number" name="stokProduk" id="stokProduk" required>
                            </div>
                            <div class="mb-3">
                                <label class="col-form-label">Berat Produk (gram)</label>
                                <input class="form-control" type="number" name="beratProduk" id="beratProduk" required>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="mb-3">
                                <label class="col-form-label">Kategori Produk</label>
                                <input class="form-control" type="text" name="kategoriProduk" id="kategoriProduk" required>
                            </div>
                            <div class="mb-3">
                                <label class="col-form-label">Deskripsi Produk</label>
                                <textarea class="form-control" name="deskripsiProduk" id="deskripsiProduk" rows="3" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="col-form-label">Foto Produk</label>
                                <input class="form-control" type="file" name="fotoProduk" id="fotoProduk">
                                <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah foto.</small>
                            </div>
                            <div class="mb-3">
                                <img id="preview-fotoProduk" src="" alt="Foto Produk" width="100">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batalkan</button>
                <button type="button" id="simpan-produk" class="btn btn-primary">Simpan</button>
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
        const tableProducts = new DataTable('#tabel-daftar-produk', {
            fixedColumns: true,
            scrollX: true,
            dom: 'Bfrtip',
            searching: true,
            buttons: [],
            ajax: {
                url: '/daftar-produk',
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
                {
                    data: null,
                    render: function (data, type, row) {
                        return `
                            <div class="d-flex align-items-center">
                                <img src="${row.fotoProduk}" alt="${row.namaProduk}" width="50" class="me-2">
                                <span>${row.namaProduk}</span>
                            </div>
                        `;
                    },
                    className: 'text-center'
                },
                {
                    data: 'hargaProduk',
                    render: function (data) {
                        return `Rp ${data}`;
                    },
                    className: 'text-center'
                },
                {
                    data: 'stokProduk',
                    className: 'text-center'
                },
                {
                    data: 'beratProduk',
                    render: function (data) {
                        return `${data} ml`;
                    },
                    className: 'text-center'
                },
                {
                    data: 'kategoriProduk',
                    className: 'text-center'
                },
                {
                    data: 'deskripsiProduk',
                    className: 'text-center'
                }
            ],
            columnDefs: [
                {
                    visible: false,
                },
            ]
        });

        tableProducts.on('click', 'tbody tr', (e) => {
            let classList = e.currentTarget.classList;

            if (classList.contains('selected')) {
                classList.remove('selected');
            }
            else {
                tableProducts.rows('.selected').nodes().each((row) => row.classList.remove('selected'));
                classList.add('selected');
            }
        });

        const modalUbahProduk = new bootstrap.Modal(document.querySelector('.ubah-data-produk'), {
            keyboard: false
        });
        $('button#ubah-data-produk').on('click', function(){
            const idProduk = tableProducts.row('.selected').id();
            idProduk ? modalUbahProduk.show() : modalUbahProduk.hide();
        });
        $('.ubah-data-produk').on('shown.bs.modal', function() {
            idProduk = tableProducts.row('.selected').data().id;
            $.ajax({
                url: '/update-data-produk/' + idProduk,
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response){
                    data = response.data;
                    $('#namaProduk').val(data.namaProduk);
                    $('#hargaProduk').val(data.hargaProduk);
                    $('#stokProduk').val(data.stokProduk);
                    $('#beratProduk').val(data.beratProduk);
                    $('#kategoriProduk').val(data.kategoriProduk);
                    $('#deskripsiProduk').val(data.deskripsiProduk);
                    $('#preview-fotoProduk').attr('src', data.fotoProduk);
                },
                error: function(error){
                    console.error(error);
                }
            })

            function toggleStatusBtn(disabled, buttonsSelector) {
                $(buttonsSelector).prop('disabled', disabled);
            }

            toggleStatusBtn(true, '#simpan-produk');

            $(".form-control").on('change input', function() {
                toggleStatusBtn(false, "#simpan-produk")
            });

            $('#simpan-produk').off('click').on('click', function(){
                $('#form-produk').submit();
            });

            $('#form-produk').off('submit').on('submit', function(e){
                e.preventDefault();

                toggleStatusBtn(true, '#batal-produk, #simpan-produk');

                let formData = new FormData($(this)[0]);
                let plainFormData = {};

                formData.forEach(function(value, key){
                    plainFormData[key] = value;
                });

                $.ajax({
                    url: '/update-data-produk/' + idProduk,
                    method: 'PUT',
                    data: JSON.stringify(plainFormData),
                    contentType: 'application/json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        $('.ubah-data-produk').modal('hide');

                        let _msgTitle = response.status ? 'Berhasil' : 'Gagal';
                            let _msg = response.status ? 'Data Produk Berhasil Diperbarui' : 'Gagal memperbarui data, terdapat kesalahan sistem.';
                            let _icon = response.status ? 'success' : 'error';

                            Swal.fire({
                                title: _msgTitle,
                                text: _msg,
                                position: "center",
                                showConfirmButton: false,
                                icon: _icon,
                                timer: 2000
                            });

                        tableProducts.ajax.reload();
                    },
                    error: function(error) {
                        console.log(error);
                    }
                }).done(function(){
                    toggleStatusBtn(false, '#batal-produk, #simpan-produk');
                });

            });
        });
        $('#hapus-data-produk').on('click', function() {
            const selectedRows = tableProducts.rows('.selected').data();
            if (selectedRows.length === 0) {
                Swal.fire({
                    title: 'Tidak Ada Produk yang Dipilih',
                    text: 'Silakan pilih produk yang ingin dihapus.',
                    icon: 'warning',
                    timer: 2000
                });
            } else {
                Swal.fire({
                    title: 'Anda yakin ingin menghapus produk yang dipilih?',
                    text: 'Tindakan ini tidak dapat dibatalkan!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        const idProduk = selectedRows.map(row => row.id);
                        $.each(idProduk, function(index, id) {
                            $.ajax({
                                url: '/delete-produk/'  + id,
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                success: function(response) {
                                    if (response.status) {
                                        Swal.fire({
                                            title: 'Berhasil',
                                            text: 'Produk berhasil dihapus.',
                                            icon: 'success',
                                            timer: 2000
                                        }).then(() => {
                                            tableProducts.ajax.reload();
                                        });
                                    } else {
                                        Swal.fire({
                                            title: 'Gagal',
                                            text: 'Terjadi kesalahan saat menghapus produk.',
                                            icon: 'error',
                                            timer: 2000
                                        });
                                    }
                                },
                                error: function(xhr, status, error) {
                                    console.error(xhr.responseText);
                                    Swal.fire({
                                        title: 'Error',
                                        text: 'Terjadi kesalahan saat menghapus produk.',
                                        icon: 'error',
                                        timer: 2000
                                    });
                                }
                            });
                        });
                    }
                });
            }
        });
    })();
</script>

@endsection
