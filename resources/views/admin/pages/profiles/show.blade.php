@extends('adminlte::page')

@section('title', "Detalhes do Perfil - {$profile->name}")

@section('content_header')
    <h1>Informações do Perfil - <strong>{{ $profile->name }}</strong><a href="{{ route('profiles.index') }}" class="btn btn-outline-info float-right"><i class="fas fa-reply"></i></a></h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('profiles.index') }}">Perfis</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('profiles.show', $profile->id) }}">{{ $profile->name }}</a></li>
    </ol>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            @include('admin.includes.alerts')
        </div>
        <div class="card-body">
            <form action="{{ route('profiles.destroy', $profile->id) }}" method="post">
                @method('DELETE')
                @csrf
                <button type="submit" class="btn btn-outline-danger float-right"><i class="fas fa-trash-alt"></i></button>
            </form>
            <ul class="list-group w-75">
                <li class="list-group-item">
                    <strong>Nome: </strong> {{ $profile->name }}
                </li>
                <li class="list-group-item">
                    <strong>Descrição: </strong> {{ $profile->description }}
                </li>
            </ul>
        </div>
        @include('admin.pages.profiles.permissions.permissions')
    </div>
@stop
