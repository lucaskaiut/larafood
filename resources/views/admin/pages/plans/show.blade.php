@extends('adminlte::page')

@section('title', "Detalhes do Plano - {$plan->name}")

@section('content_header')
    <h1>Detalhes do Plano <strong>{{ $plan->name }}</strong><a href="{{ route('plans.index') }}" class="btn btn-outline-info float-right"><i class="fas fa-reply"></i></a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('plans.destroy', $plan->url) }}" method="post">
                @method('DELETE')
                @csrf
                <button type="submit" class="btn btn-outline-danger float-right"><i class="fas fa-trash-alt"></i></button>
            </form>
            <ul>
                <li>
                    <strong>Nome: </strong> {{ $plan->name }}
                </li>
                <li>
                    <strong>Descrição: </strong> {{ $plan->description }}
                </li>
                <li>
                    <strong>Preço: </strong> R${{ number_format($plan->price, 2, ',', '.') }}
                </li>
                <li>
                    <strong>URL: </strong> {{ $plan->url }}
                </li>
            </ul>

        </div>
        <div class="card-footer">

        </div>
    </div>
@stop
