@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools">
                <a href="{{ url('/user/export_pdf') }}" class="btn btn-sm btn-warning mt-1"><i class="fa fa-filepdf"></i> Export User PDF</a>
                <button onclick="modalAction('{{ url('/user/import') }}')" class="btn btn-sm btn-info mt-1">Import</button>
                <a href="{{ url('/user/export_excel') }}" class="btn btn-sm btn-info mt-1">Export User</a>
                <button onclick="modalAction('{{ url('user/create_ajax')}}')" class="btn btn-sm btn-success mt-1">Tambah Ajax</button>
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
                        <label class="col-1 conrol-label col-from-label">Filter:</label>
                        <div class="col-3">
                            <select class="form-control" id="level_id" name="level_id" required>
                                <option value="">- Semua -</option>
                                @foreach($level as $item)
                                    <option value="{{ $item->level_id }}">{{ $item->level_name }}</option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">Level Pengguna</small>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-striped table-bordered table-hover table-sm" id="table_user">
                <thead>
                    <tr>
                        <th style="width: 7%">ID</th>
                        <th>Username</th>
                        <th>Nama</th>
                        <th>Level Pengguna</th>
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
        var dataUser;
        $(document).ready(function () {
            dataUser = $('#table_user').DataTable({
                serverSide : true,
                ajax : {
                    url : "{{ route('user.list') }}",
                    dataType : 'json',
                    type : 'get',
                    data : function (d) {
                        d.level_id = $('#level_id').val();
                    },
                },
                columns : [
                    { data : "DT_RowIndex", className : "text-center", orderable : false, searchable : false},
                    { data : "username", className : "", orderable : true, searchable : true},
                    { data : "nama", className : "", orderable : false, searchable : false},
                    { data : "level.level_name", className : "", orderable : false, searchable : false},
                    { data : "aksi", className : "", orderable : false, searchable : false},
                ],
            });

            $('#level_id').on('change',function () {
                dataUser.ajax.reload();
            });
        });
    </script>
@endpush