@extends('adminlte::page')

@section('title', 'Novo Plano')

@section('content_header')
    <h1>Novo Detalhe do Plano {{ $plan->name }} <a href="{{ route('plans.index') }}" class="btn btn-outline-info float-right"><i class="fas fa-reply"></i></a></h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('plans.index') }}">Planos</a></li>
        <li class="breadcrumb-item"><a href="{{ route('plans.show', $plan->url) }}">{{ $plan->name }}</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('details.plan.create', $plan->url) }}">Novo Detalhe</a></li>
    </ol>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form class="form col-md-6" action="{{ route('details.plan.store', $plan->url) }}" method="post">
                @csrf
                @include('admin.pages.plans.details._partials.form')
            </form>
        </div>
    </div>
@stop
