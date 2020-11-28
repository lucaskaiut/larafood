@extends('adminlte::page')

@section('title', 'Planos')

@section('content_header')
    <h1>Planos <a href="{{ route('plans.create') }}" class="btn btn-outline-success"><i class="fas fa-plus"></i></a></h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('plans.index') }}">Planos</a></li>
    </ol>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            @include('admin.includes.alerts')
            <form action="{{ route('plans.search') }}" method="post" class="form form-inline">
                @csrf
                <div class="form-group mx-sm-3 mb-2">
                    <input type="text" class="form-control" name="filter" placeholder="Nome / Descrição" value="{{ $filters['filter'] ?? '' }}">
                </div>
                <button type="submit" class="btn btn-outline-primary mb-2"><i class="fas fa-search"></i></button>
            </form>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th width="100" class="text-center">Preço</th>
                        <th>URL</th>
                        <th width="150">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($plans as $plan)
                        <tr>
                            <td class="text-left">{{ $plan->name }}</td>
                            <td class="text-right">R${{ number_format($plan->price, 2, ',', '.') }}</td>
                            <td class="text-left">{{ $plan->url }}</td>
                            <td>
                                <a href="{{ route('plans.show', $plan->url) }}" class="btn btn-outline-warning"><i class="far fa-eye"></i></a>
                                <a href="{{ route('plans.edit', $plan->url) }}" class="btn btn-outline-primary"><i class="far fa-edit"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if(isset($filters))
                {!! $plans->appends($filters)->links("pagination::bootstrap-4") !!}
            @else
                {!! $plans->links("pagination::bootstrap-4") !!}
            @endif
        </div>
    </div>
@stop
