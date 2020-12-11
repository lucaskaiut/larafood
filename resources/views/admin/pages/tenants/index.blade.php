@extends('adminlte::page')

@section('title', 'Empresas')

@section('content_header')
    <h1>Empresas <a href="{{ route('tenants.create') }}" class="btn btn-outline-success"><i class="fas fa-plus"></i></a></h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('tenants.index') }}">Empresas</a></li>
    </ol>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            @include('admin.includes.alerts')
            <form action="{{ route('tenants.search') }}" method="post" class="form form-inline">
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
                        <th>#</th>
                        <th>Nome</th>
                        <th>CNPJ</th>
                        <th>Inscrição</th>
                        <th>Expira</th>
                        <th width="200">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tenants as $tenant)
                        <tr>
                            <td class="text-left">{{ $tenant->id }}</td>
                            <td class="text-left">{{ $tenant->name }}</td>
                            <td class="text-left">{{ $tenant->cnpj }}</td>
                            <td class="text-left">{{ $tenant->subscription }}</td>
                            <td class="text-left">{{ $tenant->expires_at }}</td>
                            <td>
                                <a href="{{ route('tenants.show', $tenant->id) }}" class="btn btn-outline-warning"><i class="far fa-eye"></i></a>
                                <a href="{{ route('tenants.edit', $tenant->id) }}" class="btn btn-outline-primary"><i class="far fa-edit"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if(isset($filters))
                {!! $tenants->appends($filters)->links("pagination::bootstrap-4") !!}
            @else
                {!! $tenants->links("pagination::bootstrap-4") !!}
            @endif
        </div>
    </div>
@stop
