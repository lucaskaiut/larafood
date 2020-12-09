@extends('adminlte::page')

@section('title', 'Produtos')

@section('content_header')
    <h1>Produtos <a href="{{ route('products.create') }}" class="btn btn-outline-success"><i class="fas fa-plus"></i></a></h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('products.index') }}">Produtos</a></li>
    </ol>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            @include('admin.includes.alerts')
            <form action="{{ route('products.search') }}" method="post" class="form form-inline">
                @csrf
                <div class="form-group mx-sm-3 mb-2">
                    <input type="text" class="form-control" name="filter" placeholder="Nome / Descrição" value="{{ $filters['filter'] ?? '' }}">
                </div>
                <button type="submit" class="btn btn-outline-primary mb-2"><i class="fas fa-search"></i></button>
            </form>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th width="90px">Imagem</th>
                        <th>Nome</th>
                        <th class="d-none d-sm-table-cell">Preço</th>
                        <th width="200">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td class="text-left">
                                <img src="{{ asset("storage/{$product->image}") }}" alt="{{ $product->name }}" width="80px">
                            </td>
                            <td class="text-left">{{ $product->name }}</td>
                            <td class="text-left d-none d-sm-table-cell">R${{ number_format($product->price, 2, ',', '.') }}</td>
                            <td>
                                <a href="{{ route('products.show', $product->id) }}" class="btn btn-outline-warning"><i class="far fa-eye"></i></a>
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-outline-primary"><i class="far fa-edit"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if(isset($filters))
                {!! $products->appends($filters)->links("pagination::bootstrap-4") !!}
            @else
                {!! $products->links("pagination::bootstrap-4") !!}
            @endif
        </div>
    </div>
@stop
