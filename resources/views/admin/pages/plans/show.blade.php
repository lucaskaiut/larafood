@extends('adminlte::page')

@section('title', "Detalhes do Plano - {$plan->name}")

@section('content_header')
    <h1>Informações do Plano - <strong>{{ $plan->name }}</strong><a href="{{ route('plans.index') }}" class="btn btn-outline-info float-right"><i class="fas fa-reply"></i></a></h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('plans.index') }}">Planos</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('plans.show', $plan->url) }}">{{ $plan->name }}</a></li>
    </ol>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            @include('admin.includes.alerts')
        </div>
        <div class="card-body">
            <form action="{{ route('plans.destroy', $plan->url) }}" method="post">
                @method('DELETE')
                @csrf
                <button type="submit" class="btn btn-outline-danger float-right"><i class="fas fa-trash-alt"></i></button>
            </form>
            <ul class="list-group w-75">
                <li class="list-group-item">
                    <strong>Nome: </strong> {{ $plan->name }}
                </li>
                <li class="list-group-item">
                    <strong>Descrição: </strong> {{ $plan->description }}
                </li>
                <li class="list-group-item">
                    <strong>Preço: </strong> R${{ number_format($plan->price, 2, ',', '.') }}
                </li>
                <li class="list-group-item">
                    <strong>URL: </strong> {{ $plan->url }}
                </li>
            </ul>

        </div>
        @include('admin.pages.plans.details.index')
        <div class="card-footer">

        </div>
    </div>
@stop
