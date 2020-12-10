@extends('adminlte::page')

@section('title', "Detalhes da Empresa - {$tenant->name}")

@section('content_header')
    <h1>Informações da Empresa - <strong>{{ $tenant->name }}</strong><a href="{{ route('tenants.index') }}" class="btn btn-outline-info float-right"><i class="fas fa-reply"></i></a></h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('tenants.index') }}">Empresas</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('tenants.show', $tenant->id) }}">{{ $tenant->name }}</a></li>
    </ol>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            @include('admin.includes.alerts')
        </div>
        <div class="card-body">
            <form action="{{ route('tenants.destroy', $tenant->id) }}" method="post">
                @method('DELETE')
                @csrf
                <button type="submit" class="btn btn-outline-danger float-right"><i class="fas fa-trash-alt"></i></button>
            </form>
            <ul class="list-group w-75">
                <li class="list-group-item">
                    <strong>Nome: </strong> {{ $tenant->name }}
                </li>
                <li class="list-group-item">
                    <strong>CNPJ: </strong> {{ $tenant->cnpj }}
                </li>
                <li class="list-group-item">
                    <strong>E-Mail: </strong> {{ $tenant->email }}
                </li>
                <li class="list-group-item">
                    <strong>Plano: </strong> {{ $tenant->plan->name }}
                </li>
                <li class="list-group-item">
                    <strong>Inscrição: </strong> {{ $tenant->subscription }}
                </li>
                <li class="list-group-item">
                    <strong>Expira: </strong> {{ $tenant->expires_at }}
                </li>
                <li class="list-group-item">
                    <strong>Logo: </strong>
                </li>
                @if($tenant->logo)
                    <li class="list-group-item">
                        <img src="{{ asset("storage/{$tenant->logo}") }}" alt="{{ $tenant->name }}" width="600px">
                    </li>
                @endif
            </ul>
        </div>
    </div>
@stop
