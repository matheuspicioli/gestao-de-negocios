@extends('adminlte::page')

@section('title', 'Relatórios estoque')

@section('content_header')
    <h1>Estoque</h1>
    <ol class="breadcrumb">
        <li>
            <a href="#"><i class="fa fa-home"></i> Home</a>
        </li>
        <li>
            <a href="#"><i class="far fa-file"></i> Relatórios</a>
        </li>
        <li class="active">
            <i class="fas fa-file-pdf"></i> Estoque</a>
        </li>
    </ol>
@stop

@section('content')
    <div class="row">&nbsp;</div>

    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Relatório de estoque</h3>
                    <div class="box-tools pull-right">
                        <a href="{{ route('relatorios.estoque.gerar') }}" class="btn btn-success btn-xs">
                            PDF
                        </a>
                    </div>
                </div>

                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <table id="relatorio-table" class="table table-bordered table-hover dataTable" role="grid">
                                <thead>
                                <tr>
                                    <th>ID Item</th>
                                    <th>Evento</th>
                                    <th>Dados</th>
                                    <th>Data ocorrência</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($relatorios_estoque as $relatorio)
                                        <tr>
                                            <td>{{ $relatorio->classe_id }}</td>
                                            <td>
                                                @if ($relatorio->evento === 'created')
                                                    Criado
                                                @elseif ($relatorio->evento === 'updated')
                                                    Atualizado para
                                                @else
                                                    Excluído
                                                @endif
                                            </td>
                                            <td>{{ $relatorio->dados }}</td>
                                            <td>{{ $relatorio->created_at->format('d/m/Y H:i:s') }}</td>
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
            $('#relatorio-table').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"
                },
                "order": [[ 3, 'desc' ]]
            });
        });
    </script>
@stop
