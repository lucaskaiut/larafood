@extends('adminlte::page')

@section('title', "Categorias do Produto - {$product->name}")

@section('content_header')
    <h1>Categorias disponíveis para vincular ao produto - <strong>{{ $product->name }}</strong><a href="{{ route('products.show', $product->id) }}" class="btn btn-outline-info float-right"><i class="fas fa-reply"></i></a></h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Produtos</a></li>
        <li class="breadcrumb-item"><a href="{{ route('products.show', $product->id) }}">{{ $product->name }}</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('products.categories.available', $product->id) }}">Vincular Categoria</a></li>
    </ol>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            @include('admin.includes.alerts')
        </div>
        <div class="card-body">
            <form action="{{ route('products.categories.available', $product->id) }}" method="post" class="form form-inline">
                @csrf
                <div class="form-group mx-sm-3 mb-2">
                    <input type="text" class="form-control" name="filter" placeholder="Nome / Descrição" value="{{ $filters['filter'] ?? '' }}">
                </div>
                <button type="submit" class="btn btn-outline-primary mb-2"><i class="fas fa-search"></i></button>
            </form>
            <table class="table table-bordered col-md-9">
                <thead class="thead-light">
                <tr>
                    <th width="50"><input type="checkbox" id="checkAll"></th>
                    <th>Nome</th>
                    <th>Descrição</th>
                </tr>
                </thead>
                <tbody>
                <form action="{{ route("products.categories.attach", $product->id) }}" method="post">
                    @csrf
                    @foreach($categories as $category)
                        <tr>
                            <td class="text-left">
                                <input type="checkbox" name="categories[]" value="{{ $category->id }}">
                            </td>
                            <td class="text-left">{{ $category->name }}</td>
                            <td class="text-left">{{ $category->description }}</td>
                        </tr>
                    @endforeach
                    <td colspan="500" class="">
                        <button type="submit" class="btn btn-outline-success"><i class="far fa-save"></i></button>
                    </td>
                </form>
                </tbody>
            </table>
        </div>

    </div>
    <script src="{{ asset('/vendor/jquery/jquery.min.js')}} "></script>
    <script>
        $("#checkAll").click(function(){
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
    </script>
@stop
