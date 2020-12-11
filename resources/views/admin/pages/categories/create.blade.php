@extends('adminlte::page')

@section('title', 'Novo Categoria')

@section('content_header')
    <h1>Nova Categoria <a href="{{ route('categories.index') }}" class="btn btn-outline-info float-right"><i class="fas fa-reply"></i></a></h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Categorias</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('categories.create') }}">Nova Categoria</a></li>
    </ol>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form class="form col-md-6" action="{{ route('categories.store') }}" method="post">
                @csrf
                @include('admin.pages.categories._partials.form')
            </form>
        </div>
    </div>
@stop
