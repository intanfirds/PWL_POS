@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools">
                <a href="{{ route('kategori.create') }}" class="btn btn-sm btn-primary mt-1">Tambah</a>
            </div>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <table class="table table-striped table-bordered table-hover table-sm" id="table_kategori">
                <thead>
                    <tr>
                        <th style="width: 7%">ID</th>
                        <th>Kode</th>
                        <th>Nama</th>
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
            var dataKategori = $('#table_kategori').DataTable({
                serverSide : true,
                ajax : {
                    url : "{{ route('kategori.list') }}",
                    dataType : 'json',
                    type : 'get',
                    data : function (d) {
                        d.kategori_id = $('#kategori_id').val();
                    },
                },
                columns : [
                    { data : "DT_RowIndex", className : "text-center", orderable : false, searchable : false},
                    { data : "kode", className : "", orderable : true, searchable : true},
                    { data : "nama", className : "", orderable : false, searchable : false},
                    { data : "aksi", className : "", orderable : false, searchable : false},
                ],
            });

            $('#kategori_id').on('change',function () {
                dataKategori.ajax.reload();
            });
        });
    </script>
@endpush