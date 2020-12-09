@extends('adminlte::page')

@section('title', 'Planos')

@section('content_header')
    <h1>Perfis disponíveis para vincular - {{ $plan->name }} <a href="{{ route('plans.profiles', $plan->url) }}" class="btn btn-outline-info float-right"><i class="fas fa-reply"></i></a></h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('plans.index') }}">Planos</a></li>
        <li class="breadcrumb-item"><a href="{{ route('plans.show', $plan->url) }}">{{ $plan->name }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('plans.profiles', $plan->url) }}">Perfis</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('plans.profiles.available', $plan->url) }}">Vincular Perfil</a></li>
    </ol>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            @include('admin.includes.alerts')
            <form action="{{ route('plans.profiles.available', $plan->url) }}" method="post" class="form form-inline">
                @csrf
                <div class="form-group mx-sm-3 mb-2">
                    <input type="text" class="form-control" name="filter" placeholder="Nome / Descrição" value="{{ $filters['filter'] ?? '' }}">
                </div>
                <button type="submit" class="btn btn-outline-primary mb-2"><i class="fas fa-search"></i></button>
            </form>
        </div>
        <div class="card-body">
            <table class="table table-bordered col-md-9">
                <thead class="thead-light">
                <tr>
                    <th width="50"><input type="checkbox" id="checkAll"></th>
                    <th>Nome</th>
                    <th>Descrição</th>
                </tr>
                </thead>
                <tbody>
                <form action="{{ route("plans.profiles.attach", $plan->url) }}" method="post">
                    @csrf
                    @foreach($profiles as $profile)
                        <tr>
                            <td class="text-left">
                                <input type="checkbox" name="profiles[]" value="{{ $profile->id }}">
                            </td>
                            <td class="text-left">{{ $profile->name }}</td>
                            <td class="text-left">{{ $profile->description }}</td>
                        </tr>
                    @endforeach
                    <td colspan="500" class="">
                        <button type="submit" class="btn btn-outline-success"><i class="far fa-save"></i></button>
                    </td>
                </form>
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if(isset($filters))
                {!! $profiles->appends($filters)->links("pagination::bootstrap-4") !!}
            @else
                {!! $profiles->links("pagination::bootstrap-4") !!}
            @endif
        </div>
    </div>
    <script src="{{ asset('/vendor/jquery/jquery.min.js')}} "></script>
    <script>
        $("#checkAll").click(function(){
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
    </script>
@stop
