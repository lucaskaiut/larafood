@extends('adminlte::page')

@section('title', 'Editando plano')

@section('content_header')
    <h1>Editando Plano <strong>{{ $plan->name }}</strong> <a href="{{ route('plans.index') }}" class="btn btn-outline-info float-right"><i class="fas fa-reply"></i></a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form class="form col-md-6" action="{{ route('plans.update', $plan->url) }}" method="post">
                @csrf
                @method('PUT')
                @include('admin.pages.plans._partials.form')
            </form>
        </div>
    </div>
@stop
