@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools">
                <a href="{{ route('stock.create') }}" class="btn btn-sm btn-primary mt-1">Tambah</a>
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
                                @foreach($kategori as $item)
                                    <option value="{{ $item->kategori_id }}">{{ $item->kategori_nama }}</option>
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
                        <th>Kategori Barang</th>
                        <th>Stock Tanggal</th>
                        <th>Stock Jumlah</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@push('css')
@endpush

@push('js')
<script>
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
                { data: "kategori_nama", className: "", orderable: false, searchable: false },
                { data: "stock_tanggal", className: "", orderable: true, searchable: true },
                { data: "stock_jumlah", className: "", orderable: true, searchable: true },
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
