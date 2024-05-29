@extends('layouts.simple.master')
@section('title', 'Daftar Order')

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

    #tabel-daftar-order th,
    #tabel-daftar-order td {
        text-align: center;
        vertical-align: middle;
    }
</style>
@endsection

@section('breadcrumb-title')
<h3>Daftar Pesanan</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item active">Daftar Pesanan</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Daftar Pesanan</h5>
                        <div>
                            <button class="btn btn-sm btn-success" id="export2excel" type="button"><i
                                    class="fa fa-file-excel-o"></i> Export</button>
                            <button class="btn btn-sm btn-info px-3" style="color: white;" id="ubah-data-agen" type="button">Proses</button>
                            <button class="btn btn-sm btn-danger px-3" id="hapus-data-produk" type="button">Hapus Data
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body"> 
                    <table id="tabel-daftar-order" class="nowrap table table-striped table-bordered border-secondary">
                        <thead>
                            <tr>
                                <th>Tgl. Pesan</th>
                                <th>Bukti Pembayaran</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Harga</th>
                                <th>No Resi</th>
                                <th>Status</th>
                                <th></th>
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
                <h4 class="modal-title" id="myLargeModalLabel">Kirimkan Resi</h4>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form-agen" action="" method="post">
                    @csrf
                    @method('put')
                    <div class="col-12 col-lg-6">
                        <input type="text" id="id" hidden>
                        <div class="mb-3">
                            <label class="col-form-label">No Resi</label>
                            <input class="form-control" type="text" name="no_resi" id="no_resi" required>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Status</label>
                            <select class="form-control form-select" name="status" id="status" required>
                                <option value="verifikasi">Verifikasi</option>
                                <option value="dikirim">Dikirim</option>
                            </select>
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
(function() {
    const tableorder = new DataTable('#tabel-daftar-order', {
        fixedColumns: true,
        scrollX: true,
        dom: 'Bfrtip',
        searching: true,
        buttons: [
            {
                extend: 'excelHtml5',
                className: '_exportExcel d-none',
                title: `Data Order - {{ auth()->user()->name }}`,
                exportOptions: {
                    columns: ':not(:eq(2))'
                }
            }
        ],
        ajax: {
            url: '/daftar-order',
            type: 'GET',
            dataSrc: function(json) {
                return json.data;
            }
        },
        columns: [
            {
                data: 'tanggal',
                render: function(data, type, row) {
                    var date = new Date(data);
                    var day = date.getDate();
                    var month = date.getMonth() + 1;
                    var year = date.getFullYear();
                    return day + '/' + month + '/' + year;
                }
            },
            {
                data: 'bukti_pembayaran',
                render: function(data, type, row) {
                    if (data) {
                        return `<a class="btn btn-sm btn-info px-3" href="${data}" download="${row.nama_file_original}">Unduh</a>`;
                    } else {
                        return 'Tidak ada bukti pembayaran';
                    }
                }
            },
            { data: 'nama' },
            { data: 'alamat_detail' },
            {
                data: 'total_harga',
                render: function(data, type, row) {
                    return 'Rp' + data;
                }
            },
            {
                data: 'no_resi',
                render: function(data, type, row) {
                    return data ? data : 'No Resi Belum di Berikan';
                }
            },
            {
                data: 'status',
                render: function(data, type, row) {
                    let badgeClass = '';
                    let statusText = '';
                    if (data === 'verifikasi') {
                        badgeClass = 'badge-danger';
                        statusText = 'Verifikasi';
                    } else if (data === 'dikirim') {
                        badgeClass = 'badge-warning';
                        statusText = 'Dikirim';
                    } else if (data === 'diterima') {
                        badgeClass = 'badge-info';
                        statusText = 'Diterima';
                    } else {
                        badgeClass = 'badge-success';
                        statusText = 'Selesai';
                    }
                    return '<span class="badge ' + badgeClass + '">' + statusText + '</span>';
                }
            },
            {
                data: 'id',
                render: function(data, type, row, meta) {
                    var url = "{{ route('detail-pesanan', ['id' => 'id']) }}";
                    url = url.replace('id', row.id);
                    return '<a class="btn btn-sm" style="background-color:#AB764E; color:white;" href="' + url + '">Detail Pesanan</a>';
                }
            },
        ],
        columnDefs: [
            {
                visible: false,
            },
        ]
    });

    $('button#export2excel').on('click', function() {
        tableorder.button('._exportExcel').trigger();
    });

    tableorder.on('click', 'tbody tr', (e) => {
        let classList = e.currentTarget.classList;

        if (classList.contains('selected')) {
            classList.remove('selected');
        } else {
            tableorder.rows('.selected').nodes().each((row) => row.classList.remove('selected'));
            classList.add('selected');
        }
    });

    const modalUbahAgen = new bootstrap.Modal(document.querySelector('.ubah-data-agen'), {
        keyboard: false
    });

    $('button#ubah-data-agen').on('click', function() {
        const selectedRow = tableorder.row('.selected').data();
        if (selectedRow) {
            const idAgen = selectedRow.id;
            modalUbahAgen.show();
            // Load data for the selected order
            $.ajax({
                url: '/update-status/' + idAgen,
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    const data = response.data;
                    $('#id').val(data.id);
                    $('#no_resi').val(data.no_resi);
                    $('#status').val(data.status);
                    $('#status').prop('disabled', !!data.no_resi);
                },
                error: function(error) {
                    console.error(error);
                }
            });
        }
    });

    $('.ubah-data-agen').on('shown.bs.modal', function() {
        $('#simpan-agen').off('click').on('click', function() {
            $('#form-agen').submit();
        });

        $('#form-agen').off('submit').on('submit', function(e) {
            e.preventDefault();

            const formData = new FormData($(this)[0]);
            const idAgen = $('#id').val();
            const plainFormData = {};
            formData.forEach(function(value, key) {
                plainFormData[key] = value;
            });

            $.ajax({
                url: '/update-resi/' + idAgen,
                method: 'PUT',
                data: JSON.stringify(plainFormData),
                contentType: 'application/json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $('.ubah-data-agen').modal('hide');
                    Swal.fire({
                        title: response.status ? 'Berhasil' : 'Gagal',
                        text: response.status ? 'Data berhasil diperbarui' : 'Gagal memperbarui data',
                        icon: response.status ? 'success' : 'error',
                        timer: 2000
                    });
                    tableorder.ajax.reload();
                },
                error: function(error) {
                    console.error(error);
                    Swal.fire({
                        title: 'Error',
                        text: 'Terjadi kesalahan saat memperbarui data',
                        icon: 'error',
                        timer: 2000
                    });
                }
            });
        });
    });

    $('#hapus-data-produk').on('click', function() {
        const selectedRows = tableorder.rows('.selected').data();
        if (selectedRows.length === 0) {
            Swal.fire({
                title: 'Tidak Ada Pesanan yang Dipilih',
                text: 'Silakan pilih pesanan yang ingin dihapus.',
                icon: 'warning',
                timer: 2000
            });
        } else {
            Swal.fire({
                title: 'Anda yakin ingin menghapus pesanan yang dipilih?',
                text: 'Tindakan ini tidak dapat dibatalkan!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    const idsToDelete = selectedRows.map(row => row.id);
                    idsToDelete.each((id) => {
                        $.ajax({
                            url: '/delete-order/' + id,
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                if (response.status) {
                                    Swal.fire({
                                        title: 'Berhasil',
                                        text: 'Pesanan berhasil dihapus.',
                                        icon: 'success',
                                        timer: 2000
                                    }).then(() => {
                                        tableorder.ajax.reload();
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'Gagal',
                                        text: 'Terjadi kesalahan saat menghapus pesanan.',
                                        icon: 'error',
                                        timer: 2000
                                    });
                                }
                            },
                            error: function(xhr, status, error) {
                                Swal.fire({
                                    title: 'Error',
                                    text: 'Terjadi kesalahan saat menghapus pesanan.',
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
