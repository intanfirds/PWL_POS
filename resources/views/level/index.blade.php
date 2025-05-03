@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools">
                <button onclick="modalAction('{{ url('/level/import') }}')" class="btn btn-sm btn-info mt-1">Import</button>
                <a href="{{ url('/level/export_excel') }}" class="btn btn-sm btn-info mt-1">Export Level</a>
                <button onclick="modalAction('{{ url('level/create_ajax')}}')" class="btn btn-sm btn-success mt-1">Tambah Ajax</button>
            </div>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <table class="table table-striped table-bordered table-hover table-sm" id="table_level">
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
            var dataLevel = $('#table_level').DataTable({
                serverSide : true,
                ajax : {
                    url : "{{ route('level.list') }}",
                    dataType : 'json',
                    type : 'get',
                    data : function (d) {
                        d.level_id = $('#level_id').val();
                    },
                },
                columns : [
                    { data : "DT_RowIndex", className : "text-center", orderable : false, searchable : false},
                    { data : "kode", className : "", orderable : true, searchable : true},
                    { data : "nama", className : "", orderable : false, searchable : false},
                    { data : "aksi", className : "", orderable : false, searchable : false},
                ],
            });

            $('#level_id').on('change',function () {
                dataLevel.ajax.reload();
            });
        });
    </script>
@endpush