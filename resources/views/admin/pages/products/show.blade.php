@extends('adminlte::page')

@section('title', "Detalhes da Categoria - {$category->name}")

@section('content_header')
    <h1>Informações da Categoria - <strong>{{ $category->name }}</strong><a href="{{ route('categories.index') }}" class="btn btn-outline-info float-right"><i class="fas fa-reply"></i></a></h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Categorias</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('categories.show', $category->id) }}">{{ $category->name }}</a></li>
    </ol>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            @include('admin.includes.alerts')
        </div>
        <div class="card-body">
            <form action="{{ route('categories.destroy', $category->id) }}" method="post">
                @method('DELETE')
                @csrf
                <button type="submit" class="btn btn-outline-danger float-right"><i class="fas fa-trash-alt"></i></button>
            </form>
            <ul class="list-group w-75">
                <li class="list-group-item">
                    <strong>Nome: </strong> {{ $category->name }}
                </li>
                <li class="list-group-item">
                    <strong>Descrição: </strong> {{ $category->description }}
                </li>
            </ul>
        </div>
    </div>
@stop
