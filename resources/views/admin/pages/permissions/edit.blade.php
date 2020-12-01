@extends('adminlte::page')

@section('title', 'Editando Permissão')

@section('content_header')
    <h1>Editando Permissão <strong>{{ $permission->name }}</strong> <a href="{{ route('permissions.index') }}" class="btn btn-outline-info float-right"><i class="fas fa-reply"></i></a></h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('permissions.index') }}">Permissões</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('permissions.edit', $permission->id) }}">{{ $permission->name }}</a></li>
    </ol>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form class="form col-md-6" action="{{ route('permissions.update', $permission->id) }}" method="post">
                @csrf
                @method('PUT')
                @include('admin.pages.permissions._partials.form')
            </form>
        </div>
    </div>
@stop
