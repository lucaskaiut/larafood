@extends('adminlte::page')

@section('title', 'Nova Mesa')

@section('content_header')
    <h1>Nova Mesa <a href="{{ route('tables.index') }}" class="btn btn-outline-info float-right"><i class="fas fa-reply"></i></a></h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('tables.index') }}">Mesas</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('tables.create') }}">Nova Mesa</a></li>
    </ol>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form class="form col-md-6" action="{{ route('tables.store') }}" method="post">
                @csrf
                @include('admin.pages.tables._partials.form')
            </form>
        </div>
    </div>
@stop
