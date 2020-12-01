@extends('adminlte::page')

@section('title', 'Novo Permissão')

@section('content_header')
    <h1>Novo Permissão <a href="{{ route('permissions.index') }}" class="btn btn-outline-info float-right"><i class="fas fa-reply"></i></a></h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('permissions.index') }}">Perfis</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('permissions.create') }}">Nova Permissão</a></li>
    </ol>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form class="form col-md-6" action="{{ route('permissions.store') }}" method="post">
                @csrf
                @include('admin.pages.permissions._partials.form')
            </form>
        </div>
    </div>
@stop
