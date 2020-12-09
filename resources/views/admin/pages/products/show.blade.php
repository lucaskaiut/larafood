@extends('adminlte::page')

@section('title', "Detalhes do Produto - {$product->name}")

@section('content_header')
    <h1>Informações do Produto - <strong>{{ $product->name }}</strong><a href="{{ route('products.index') }}" class="btn btn-outline-info float-right"><i class="fas fa-reply"></i></a></h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Produtos</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('products.show', $product->id) }}">{{ $product->name }}</a></li>
    </ol>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            @include('admin.includes.alerts')
        </div>
        <div class="card-body">
            <form action="{{ route('products.destroy', $product->id) }}" method="post">
                @method('DELETE')
                @csrf
                <button type="submit" class="btn btn-outline-danger float-right"><i class="fas fa-trash-alt"></i></button>
            </form>
            <ul class="list-group w-75">
                <li class="list-group-item">
                    <strong>Nome: </strong> {{ $product->name }}
                </li>
                <li class="list-group-item">
                    <strong>Descrição: </strong> {{ $product->description }}
                </li>
                <li class="list-group-item">
                    <strong>Preço: </strong> R${{ number_format($product->price, 2, ',', '.') }}
                </li>
                <li class="list-group-item">
                    <strong>Imagem: </strong>
                </li>
                <li class="list-group-item">
                    <img src="{{ asset("storage/{$product->image}") }}" alt="{{ $product->name }}" width="600px">
                </li>
            </ul>
        </div>
    </div>
@stop
