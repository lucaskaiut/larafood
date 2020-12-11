@extends('adminlte::page')

@section('title', 'Novo Perfil')

@section('content_header')
    <h1>Novo Usuário <a href="{{ route('users.index') }}" class="btn btn-outline-info float-right"><i class="fas fa-reply"></i></a></h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Usuários</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('users.create') }}">Novo Usuário</a></li>
    </ol>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form class="form col-md-6" action="{{ route('users.store') }}" method="post">
                @csrf
                @include('admin.pages.users._partials.form')
            </form>
        </div>
    </div>
@stop
