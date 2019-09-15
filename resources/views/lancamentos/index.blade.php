@extends('adminlte::page')

@section('title', 'Movimentações')

@section('content_header')
    <h1>Movimentações</h1>
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
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Cadastro de lançamento</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" type="button" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                        <button class="btn btn-box-tool" type="button" data-widget="remove">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>

                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-12">
                            {!! Form::open(['route' => ['lancamentos.criar']]) !!}
                            @include('lancamentos._form')
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
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" type="button" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                        <button class="btn btn-box-tool" type="button" data-widget="remove">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>

                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <table id="produtos-table" class="table table-bordered table-hover dataTable" role="grid">
                                <thead>
                                <tr>
                                    <th>Itens</th>
                                    <th>Quantidade</th>
                                    <th>Tipo</th>
                                    <th>Preço total</th>
                                    <th>Ações</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($lancamentos as $lancamento)
                                        <tr>
                                            <td>
                                                @foreach($lancamento->itens as $item)
                                                    {{ $item->nome }} @if (!$loop->last), @endif
                                                @endforeach
                                            </td>
                                            <td>{{ $lancamento->quantidade }}</td>
                                            <td>{{ $lancamento->tipo }}</td>
                                            <td>
                                                R$ {{ number_format($lancamento->preco_total, 2, ',', '.') }}
                                            </td>
                                            <td width="10%">
                                                <a href="{{ route('lancamentos.editar', ['id' => $lancamento->id]) }}"
                                                   class="btn btn-xs btn-warning">
                                                    <i class="fa fa-pencil-alt"></i>
                                                </a>

                                                <form style="display: inline-block" action="{{ route('lancamentos.deletar', ['id' => $lancamento->id]) }}" method="POST">
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

            $('#items[]').select2();

            $('#produto_id').attr('disabled', true);
            $('#servico_id').attr('disabled', true);

            $('#item').change(function (event) {
                var value = event.target.value;
                if (value === 'S') {
                    $('#servico_id').attr('disabled', false);
                    $('#produto_id').attr('disabled', true);
                } else if (value === 'P') {
                    $('#servico_id').attr('disabled', true);
                    $('#produto_id').attr('disabled', false);
                } else {
                    $('#servico_id').attr('disabled', true);
                    $('#produto_id').attr('disabled', true);
                }
            });
        });
    </script>
@stop
