@extends('adminlte::page')

@section('title', 'Planos')

@section('content_header')
    <h1>
        Perfis do Plano - {{ $plan->name }}
        <a href="{{ route('plans.profiles.available', $plan->url) }}" class="btn btn-outline-success"><i class="fas fa-plus"></i></a>
        <a href="{{ route('plans.index') }}" class="btn btn-outline-info float-right"><i class="fas fa-reply"></i></a>
    </h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('plans.index') }}">Planos</a></li>
        <li class="breadcrumb-item"><a href="{{ route('plans.show', $plan->url) }}">{{ $plan->name }}</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('plans.profiles', $plan->url) }}">Perfis</a></li>
    </ol>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            @include('admin.includes.alerts')
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
                <form action="{{ route("plans.profiles.detach", $plan->url) }}" method="post">
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
                        <button type="submit" class="btn btn-outline-danger"><i class="fas fa-trash-alt"></i></button>
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
