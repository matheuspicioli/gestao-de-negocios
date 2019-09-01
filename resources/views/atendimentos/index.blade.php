@extends('adminlte::page')

@section('title', 'Movimentações')

@section('content_header')
    <h1>Movimentação de <small>serviços</small></h1>
    <ol class="breadcrumb">
        <li>
            <a href="#"><i class="fa fa-home"></i> Home</a>
        </li>
        <li class="active">
            <i class="fa fa-home"></i> Movimentações</a>
        </li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <a href="{{ route('produtos.criar') }}" class="btn btn-primary">
                <i class="fa fa-plus"></i>
                Lançar
            </a>
        </div>
    </div>

    <div class="row">
        &nbsp;
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Listagem</h3>
                </div>

                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <table id="produtos-table" class="table table-bordered table-hover dataTable" role="grid">
                                <thead>
                                <tr>
                                    <th>Produto/Serviço</th>
                                    <th>Custo</th>
                                    <th>Quantidade</th>
                                    <th>Ações</th>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
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
            $('#produtos-table').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"
                }
            });
        })
    </script>
@stop
