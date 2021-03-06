@extends('adminlte::page')

@section('title', 'Itens')

@section('content_header')
    <h1>Listagem de <small>Itens</small></h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('home') }}"><i class="fa fa-home"></i> Home</a>
        </li>
        <li class="active">
            <i class="fa fa-list"></i> Itens
        </li>
    </ol>
@stop

@section('content')
{{--    <div class="row">--}}
{{--        <div class="col-xs-12">--}}
{{--            <a href="{{ route('itens.criar') }}" class="btn btn-primary">--}}
{{--                <i class="fa fa-plus"></i>--}}
{{--                Criar--}}
{{--            </a>--}}
{{--        </div>--}}
{{--    </div>--}}

    <div class="row">&nbsp;</div>

    <div class="row">
        <div class="col-xs-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Cadastro de item</h3>
                </div>

                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-12">
                            {!! Form::open(['route' => ['itens.salvar']]) !!}
                            @include('itens._form')
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Listagem</h3>
                </div>

                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <table id="itens-table" class="table table-bordered table-hover dataTable" role="grid">
                                <thead>
                                    <tr>
                                        <th>Código</th>
                                        <th>Nome</th>
                                        <th>Quantidade</th>
                                        <th>Valor</th>
                                        <th>Tipo</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($itens as $item)
                                    <tr>
                                        <td>{{ $item->code }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>R$ {{ number_format($item->value, 2, ',', '.') }}</td>
                                        <td>{{ $item->type }}</td>
                                        <td width="10%">
                                            <a href="{{ route('itens.editar', ['id' => $item->id]) }}"
                                               class="btn btn-xs btn-warning">
                                                <i class="fa fa-pencil-alt"></i>
                                            </a>

                                            <form style="display: inline-block" action="{{ route('itens.deletar', ['id' => $item->id]) }}" method="POST">
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
            $('#itens-table').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"
                }
            });
        })
    </script>
@stop
