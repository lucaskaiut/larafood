@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
    </ol>
@stop

@section('content')
    <div class="row">
        @can('view_users')
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-primary"><i class="fa fa-users"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Usuários</span>
                        <span class="info-box-number">{{ $users }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
        @endcan
        @can('view_tables')
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-primary"><i class="fas fa-tablet-alt"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Mesas</span>
                        <span class="info-box-number">{{ $tables }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
        @endcan
        @can('view_categories')
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-primary"><i class="fas fa-layer-group"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Categorias</span>
                        <span class="info-box-number">{{ $categories }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
        @endcan
        @can('view_products')
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-primary"><i class="fas fa-store"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Produtos</span>
                        <span class="info-box-number">{{ $products }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
        @endcan
        @admin()
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-primary"><i class="fas fa-briefcase"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Empresas</span>
                    <span class="info-box-number">{{ $tenants }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        @endadmin
    </div>
@stop
