@extends('layout.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Kategori')
@section('content_header_title','Home')
@section('content_header_subtitle','Kategori')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Manage Kategori</h3>
            <div class="card-tools">
                <a href="/kategori/create" class="btn btn-sm btn-primary">
                    <i class="fas fa-plus"></i> Create
                </a>
            </div>
            <div class="card-body">
                {{$dataTable->table(['class' => 'table table-bordered table-striped'])}}
            </div>          
        </div>
    </div>
@endsection

@push('scripts')
    {{$dataTable->scripts()}}
@endpush