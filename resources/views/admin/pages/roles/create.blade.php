@extends('adminlte::page')

@section('title', 'Novo Cargo')

@section('content_header')
    <h1>Novo Cargo <a href="{{ route('roles.index') }}" class="btn btn-outline-info float-right"><i class="fas fa-reply"></i></a></h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Cargos</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('roles.create') }}">Novo Cargo</a></li>
    </ol>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form class="form col-md-6" action="{{ route('roles.store') }}" method="post">
                @csrf
                @include('admin.pages.roles._partials.form')
            </form>
        </div>
    </div>
@stop
