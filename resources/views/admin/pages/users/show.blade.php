@extends('adminlte::page')

@section('title', "Detalhes do Usuário - {$user->name}")

@section('content_header')
    <h1>Informações do Usuário - <strong>{{ $user->name }}</strong><a href="{{ route('users.index') }}" class="btn btn-outline-info float-right"><i class="fas fa-reply"></i></a></h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Usuários</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('users.show', $user->id) }}">{{ $user->name }}</a></li>
    </ol>
@stop

@section('content')
    <div class="card">
        <div class="card-header">

        </div>
        <div class="card-body">
            @include('admin.includes.alerts')
            <form action="{{ route('users.destroy', $user->id) }}" method="post">
                @method('DELETE')
                @csrf
                <button type="submit" class="btn btn-outline-danger float-right"><i class="fas fa-trash-alt"></i></button>
            </form>
            <ul class="list-group w-75">
                <li class="list-group-item">
                    <strong>Nome: </strong> {{ $user->name }}
                </li>
                <li class="list-group-item">
                    <strong>E-Mail: </strong> {{ $user->email }}
                </li>
            </ul>
            @include('admin.pages.users.roles.roles')
        </div>
    </div>
@stop
