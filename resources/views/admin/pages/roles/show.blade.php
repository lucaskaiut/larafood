@extends('adminlte::page')

@section('title', "Detalhes do Cargo - {$role->name}")

@section('content_header')
    <h1>Informações do Cargo - <strong>{{ $role->name }}</strong><a href="{{ route('roles.index') }}" class="btn btn-outline-info float-right"><i class="fas fa-reply"></i></a></h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Cargos</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('roles.show', $role->id) }}">{{ $role->name }}</a></li>
    </ol>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            @include('admin.includes.alerts')
        </div>
        <div class="card-body">
            <form action="{{ route('roles.destroy', $role->id) }}" method="post">
                @method('DELETE')
                @csrf
                <button type="submit" class="btn btn-outline-danger float-right"><i class="fas fa-trash-alt"></i></button>
            </form>
            <ul class="list-group w-75">
                <li class="list-group-item">
                    <strong>Nome: </strong> {{ $role->name }}
                </li>
                <li class="list-group-item">
                    <strong>Descrição: </strong> {{ $role->description }}
                </li>
            </ul>
        </div>
        @include('admin.pages.roles.permissions.permissions')
    </div>
@stop
