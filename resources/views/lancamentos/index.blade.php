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
{{--                        <button class="btn btn-box-tool" type="button" data-widget="remove">--}}
{{--                            <i class="fa fa-times"></i>--}}
{{--                        </button>--}}
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
            var itensToApi = [];

            $('#produtos-table').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"
                }
            });

            $('.select2').select2();

            $('#adicionar-item').on('click', function (event) {
                // @todo TRABALHAR COM O ITEM PARA OBTER O VALOR
                var item = null;
                $.ajax('api/consultar-item/'+$('#item').val(), {
                    type: 'GET',
                    success: function (resultado, status, xhr) {
                        item = resultado;
                        var wrapper = $('#wrapper');
                        var quantidade = $('#quantidade');
                        var preco = 'R$ ' + `${parseFloat(item.preco * quantidade.val()).toFixed(2)}`.replace('.', ',');
                        var precoUnitatio = 'R$ ' + `${parseFloat(item.preco).toFixed(2)}`.replace('.', ',');

                        var html = `<tr><td>${item.nome}</td><td>${quantidade.val()}</td><td>${precoUnitatio}</td><td class='preco' data-preco='${item.preco}' data-quantidade='${quantidade.val()}'>${preco}</td><td><button class='btn btn-xs btn-danger remover-item' data-id='${item.id}' type='button'><i class="fa fa-trash"></i></button></td></tr>`;
                        wrapper.prepend(html);
                        quantidade.val(1);
                        calcularPrecoTotal();
                        itensToApi.push(item);
                    },
                    error: function (xhr, status, error) {
                        window.alert('Ocorreu um erro ao cadastrar o item: '+error);
                    }
                });
            });

            $('#wrapper').on('click', '.remover-item', function (event) {
                // 1º PARENT = TD, 2º PARENT = TR
                var isto = $(this);
                isto.parent().parent().remove();
                calcularPrecoTotal();
                itensToApi = itensToApi.filter(function (item) {
                    var id = parseInt(isto[0].dataset.id);
                    if (item.id === id) {
                        console.log('removendo item: '+item.nome+' da lista');
                    }

                    return item.id !== id;
                });
                console.log(itensToApi);
            });

            var calcularPrecoTotal = function() {
                var total = 0;
                var precos = $('.preco').each(function (index, value) {
                    var valor = value.dataset.preco;
                    var quantidade = value.dataset.quantidade;
                    total += parseFloat(valor * quantidade);
                });

                $('#valor-total').html(`R$ ${total.toFixed(2)}`.replace('.', ','));
            }
        });
    </script>
@stop
