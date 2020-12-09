@extends('adminlte::page')

@section('title', 'Mesas')

@section('content_header')
    <h1>Mesas <a href="{{ route('tables.create') }}" class="btn btn-outline-success"><i class="fas fa-plus"></i></a></h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('tables.index') }}">Mesas</a></li>
    </ol>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            @include('admin.includes.alerts')
            <form action="{{ route('tables.search') }}" method="post" class="form form-inline">
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
                        <th>Descrição</th>
                        <th width="200">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tables as $table)
                        <tr>
                            <td class="text-left">{{ $table->id }}</td>
                            <td class="text-left">{{ $table->name }}</td>
                            <td class="text-left">{{ $table->description }}</td>
                            <td>
                                <a href="{{ route('tables.show', $table->id) }}" class="btn btn-outline-warning"><i class="far fa-eye"></i></a>
                                <a href="{{ route('tables.edit', $table->id) }}" class="btn btn-outline-primary"><i class="far fa-edit"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if(isset($filters))
                {!! $tables->appends($filters)->links("pagination::bootstrap-4") !!}
            @else
                {!! $tables->links("pagination::bootstrap-4") !!}
            @endif
        </div>
    </div>
@stop
