@extends('adminlte::page')

@section('title', 'Novo Perfil')

@section('content_header')
    <h1>Novo Perfil <a href="{{ route('profiles.index') }}" class="btn btn-outline-info float-right"><i class="fas fa-reply"></i></a></h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('profiles.index') }}">Perfis</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('profiles.create') }}">Novo Perfil</a></li>
    </ol>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form class="form col-md-6" action="{{ route('profiles.store') }}" method="post">
                @csrf
                @include('admin.pages.profiles._partials.form')
            </form>
        </div>
    </div>
@stop
