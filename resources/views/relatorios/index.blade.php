@extends('adminlte::page')

@section('title', 'Relatórios')

@section('content_header')
    <h1>Relatórios</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('home') }}"><i class="fa fa-home"></i> Home</a>
        </li>
        <li class="active">
            <i class="far fa-file"></i> Relatórios</a>
        </li>
    </ol>
@stop

@section('content')
    <div class="row">&nbsp;</div>

    <div class="row">
        <div class="col-xs-6">
            <div class="info-box">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="far fa-file"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Estoque</span>
                        <span class="info-box-number">{{ $quantidade_itens }}</span>
                        <div class="pull-right">
                            <a href="{{ route('relatorios.estoque.index') }}" class="btn btn-warning">
                                <i class="fa fa-eye"></i>
                            </a>
                        </div>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>
        </div>

        <div class="col-xs-6">
            <div class="info-box">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="far fa-file"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Lançamentos</span>
                        <span class="info-box-number">{{ $quantidade_lancamentos }}</span>
                        <div class="pull-right">
                            <a href="{{ route('relatorios.lancamento.index') }}" class="btn btn-warning">
                                <i class="fa fa-eye"></i>
                            </a>
                        </div>
                    </div>
                    <!-- /.info-box-content -->

                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
@stop

@section('js')
    <script>
        $(function () {

        });
    </script>
@stop
