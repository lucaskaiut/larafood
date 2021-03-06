@extends('adminlte::page')

@section('title', "Detalhes do Cargo - {$role->name}")

@section('content_header')
    <h1>Permissões disponíveis para vincular ao Cargo - <strong>{{ $role->name }}</strong><a href="{{ route('roles.show', $role->id) }}" class="btn btn-outline-info float-right"><i class="fas fa-reply"></i></a></h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Cargos</a></li>
        <li class="breadcrumb-item"><a href="{{ route('roles.show', $role->id) }}">{{ $role->name }}</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('roles.permissions.available', $role->id) }}">Vincular Permissão</a></li>
    </ol>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            @include('admin.includes.alerts')
        </div>
        <div class="card-body">
            <form action="{{ route('roles.permissions.available', $role->id) }}" method="post" class="form form-inline">
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
                <form action="{{ route("roles.permissions.attach", $role->id) }}" method="post">
                    @csrf
                    @foreach($permissions as $permission)
                        <tr>
                            <td class="text-left">
                                <input type="checkbox" name="permissions[]" value="{{ $permission->id }}">
                            </td>
                            <td class="text-left">{{ $permission->name }}</td>
                            <td class="text-left">{{ $permission->description }}</td>
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
