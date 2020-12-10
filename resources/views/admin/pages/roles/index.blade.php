@extends('adminlte::page')

@section('title', 'Cargos')

@section('content_header')
    <h1>Cargos <a href="{{ route('roles.create') }}" class="btn btn-outline-success"><i class="fas fa-plus"></i></a></h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('roles.index') }}">Cargos</a></li>
    </ol>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            @include('admin.includes.alerts')
            <form action="{{ route('roles.search') }}" method="post" class="form form-inline">
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
                        <th>Nome</th>
                        <th class="d-none d-sm-table-cell">Descrição</th>
                        <th width="200">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($roles as $role)
                        <tr>
                            <td class="text-left">{{ $role->name }}</td>
                            <td class="text-left d-none d-sm-table-cell">{{ $role->description }}</td>
                            <td>
                                <a href="{{ route('roles.show', $role->id) }}" class="btn btn-outline-warning"><i class="far fa-eye"></i></a>
                                <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-outline-primary"><i class="far fa-edit"></i></a>
                                <a href="" class="btn btn-outline-dark"><i class="fas fa-lock"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if(isset($filters))
                {!! $roles->appends($filters)->links("pagination::bootstrap-4") !!}
            @else
                {!! $roles->links("pagination::bootstrap-4") !!}
            @endif
        </div>
    </div>
@stop
