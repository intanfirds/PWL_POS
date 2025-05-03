@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools">
                <button onclick="modalAction('{{ url('/stock/import') }}')" class="btn btn-sm btn-info mt-1">Import</button>
                <a href="{{ url('/stock/export_excel') }}" class="btn btn-sm btn-info mt-1">Export Stock</a>
                <button onclick="modalAction('{{ url('stock/create_ajax')}}')" class="btn btn-sm btn-success mt-1">Tambah Ajax</button>
            </div>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group row">
                        <label class="col-1 conrol-label col-from-label">Kategori Barang</label>
                        <div class="col-3">
                            <select class="form-control" id="kategori_id" name="kategori_id" required>
                                <option value="">- Semua -</option>
                                @foreach($kategoriUnik as $item)
                                    <option value="{{ $item->kategori_id }}">{{ $item->kategori->kategori_nama }}</option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">Kategori Barang</small>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-striped table-bordered table-hover table-sm" id="table_stock">
                <thead>
                    <tr>
                        <th style="width: 7%">ID</th>
                        <th>Nama Barang</th>
                        <th>Stock Tanggal</th>
                        <th>Stock Jumlah</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" 
    data-backdrop="static" data-keyboard="false" data-width="75%" aria-hidden="true" >
@endsection

@push('css')
@endpush

@push('js')
<script>
    function modalAction(url) {
            $('#myModal').load(url, function() {
                $('#myModal').modal('show');
            });
        }
    $(document).ready(function () {
        var dataStock = $('#table_stock').DataTable({
            serverSide: true,
            processing: true,
            ajax: {
                url: "{{ route('stock.list') }}", // Sesuaikan dengan route kamu
                dataType: 'json',
                type: 'get',
                data: function (d) {
                    d.kategori_id = $('#kategori_id').val(); // Ambil filter dari select
                },
            },
            columns: [
                { data: "DT_RowIndex", className: "text-center", orderable: false, searchable: false },
                { data: "barang.barang_nama", className: "", orderable: false, searchable: true },
                { data: "stok_tanggal", className: "", orderable: true, searchable: true },
                { data: "stok_jumlah", className: "", orderable: true, searchable: true },
                { data: "aksi", className: "", orderable: false, searchable: false },
            ],
        });

        // Trigger reload saat kategori dipilih
        $('#kategori_id').on('change', function () {
            dataStock.ajax.reload();
        });
    });
</script>
@endpush
