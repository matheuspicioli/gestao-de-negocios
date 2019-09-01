@extends('adminlte::page')

@section('title', 'Produtos')

@section('content_header')
    <h1>Listagem de <small>Produtos</small></h1>
    <ol class="breadcrumb">
        <li>
            <a href="#"><i class="fa fa-home"></i> Home</a>
        </li>
        <li class="active">
            <i class="fa fa-home"></i> Produtos</a>
        </li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <a href="{{ route('produtos.criar') }}" class="btn btn-primary">
                <i class="fa fa-plus"></i>
                Criar
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
                                        <th>Nome</th>
                                        <th>Preço</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($produtos as $produto)
                                    <tr>
                                        <td>{{ $produto->nome }}</td>
                                        <td>R$ {{ number_format($produto->preco, 2, ',', '.') }}</td>
                                        <td width="10%">
                                            <a href="{{ route('produtos.editar', ['id' => $produto->id]) }}"
                                               class="btn btn-xs btn-warning">
                                                <i class="fa fa-pencil-alt"></i>
                                            </a>

                                            <form action="{{ route('produtos.deletar', ['id' => $produto->id]) }}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('delete') }}
                                                <button type="submit" class="btn btn-xs btn-danger">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
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
