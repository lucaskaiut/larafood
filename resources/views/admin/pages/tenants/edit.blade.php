@extends('adminlte::page')

@section('title', 'Editando Empresa')

@section('content_header')
    <h1>Editando Empresa <strong>{{ $tenant->name }}</strong> <a href="{{ route('tenants.index') }}" class="btn btn-outline-info float-right"><i class="fas fa-reply"></i></a></h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('tenants.index') }}">Empresas</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('tenants.edit', $tenant->id) }}">{{ $tenant->name }}</a></li>
    </ol>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form class="form col-md-6" action="{{ route('tenants.update', $tenant->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @include('admin.pages.tenants._partials.form')
            </form>
        </div>
    </div>
@stop
