@extends('adminlte::page')

@section('title', "Detalhes do Usuário - {$user->name}")

@section('content_header')
    <h1>Cargos disponíveis para vincular ao Usuário - <strong>{{ $user->name }}</strong><a href="{{ route('users.show', $user->id) }}" class="btn btn-outline-info float-right"><i class="fas fa-reply"></i></a></h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Usuários</a></li>
        <li class="breadcrumb-item"><a href="{{ route('users.show', $user->id) }}">{{ $user->name }}</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('users.roles.available', $user->id) }}">Vincular Cargo</a></li>
    </ol>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            @include('admin.includes.alerts')
        </div>
        <div class="card-body">
            <form action="{{ route('users.roles.available', $user->id) }}" method="post" class="form form-inline">
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
                <form action="{{ route("users.roles.attach", $user->id) }}" method="post">
                    @csrf
                    @foreach($roles as $role)
                        <tr>
                            <td class="text-left">
                                <input type="checkbox" name="roles[]" value="{{ $role->id }}">
                            </td>
                            <td class="text-left">{{ $role->name }}</td>
                            <td class="text-left">{{ $role->description }}</td>
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
