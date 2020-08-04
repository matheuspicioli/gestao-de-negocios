@extends('adminlte::page')

@section('title', 'Movimentações')

@section('content_header')
    <h1>Movimentações</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('home') }}"><i class="fa fa-home"></i> Home</a>
        </li>
        <li class="active">
            <i class="fa fa-home"></i> Movimentações
        </li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Lançamento de pedidos</h3>
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
                    <h3 class="box-title">Pedidos</h3>
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
                                    <th>#</th>
                                    <th>Produtos</th>
                                    <th>Pagamento</th>
                                    <th>Transação</th>
                                    <th>Valor total</th>
                                    <th>Ações</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($entries as $entry)
                                    <tr>
                                        <td>
                                            {{ $entry->id }}
                                        </td>
                                        <td>
                                            {!! $entry->itemsString !!}
                                        </td>
                                        <td>
                                            {{ $entry->payment }}
                                        </td>
                                        <td>{{ $entry->transaction }}</td>
                                        <td>
                                            R$ {{ number_format($entry->total_price, 2, ',', '.') }}
                                        </td>
                                        <td width="10%">
                                            <a href="{{ route('lancamentos.editar', ['id' => $entry->id]) }}"
                                               class="btn btn-xs btn-warning">
                                                <i class="fa fa-pencil-alt"></i>
                                            </a>

                                            <form style="display: inline-block" action="{{ route('lancamentos.deletar', ['id' => $entry->id]) }}" method="POST">
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
            let itensToApi = [];

            $('#produtos-table').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"
                }
            });

            $('.select2').select2();

            $('#adicionar-item').on('click', function (event) {
                let item = null;
                $.ajax('api/item/'+$('#item').val(), {
                    type: 'GET',
                    success: function (resultado, status, xhr) {
                        let wrapper = $('#wrapper')
                        let quantity = $('#quantidade')

                        item = resultado;
                        item.quantity = parseInt(quantity.val());

                        let price = 'R$ ' + `${parseFloat(item.value * quantity.val()).toFixed(2)}`.replace('.', ',');
                        let precoUnitatio = 'R$ ' + `${parseFloat(item.value).toFixed(2)}`.replace('.', ',');
                        let html = `<tr><td>${quantity.val()}</td><td>${item.name}</td><td>${precoUnitatio}</td><td class='preco' data-preco='${item.value}' data-quantidade='${quantity.val()}'>${price}</td><td><button class='btn btn-xs btn-danger remover-item' data-id='${item.id}' type='button'><i class="fa fa-trash"></i></button></td></tr>`;

                        wrapper.prepend(html);
                        quantity.val(1);
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

                // ARRAY QUE É ENVIADO AO BACKEND
                itensToApi = itensToApi.filter(function (item) {
                    var id = parseInt(isto[0].dataset.id);
                    return item.id !== id;
                });
            });

            var calcularPrecoTotal = function() {
                var total = 0;
                $('.preco').each(function (index, item) {
                    var value = item.dataset.preco;
                    var quantity = item.dataset.quantidade;
                    total += parseFloat(value * quantity);
                });

                $('#valor-total').html(`R$ ${total.toFixed(2)}`.replace('.', ','));
            }

            var resetar = function () {
                var wrapper = $('#wrapper');
                wrapper.html('');
                $('#valor-total').html('R$ 0');
                $('#quantidade').val(1);
                itensToApi = []
            };

            $('#salvar-lancamento').click(function (event) {
                event.preventDefault();
                if (itensToApi === []) {
                    alert('Adicione algum item para salvar o pedido');
                    return;
                }

                $.ajax('api/save-entry', {
                    type: 'POST',
                    data: {
                        itens: itensToApi,
                        type: $('#type').val(),
                        user_id: $('#user_id').val(),
                        payment_id: $('#payment_id').children("option:selected").val()
                    },
                    success: function (response) {
                        alert(`Pedio cadastrado com sucesso!`);
                        window.location = window.location
                    },
                    error: function (xhr, status, error) {
                        alert(xhr.responseJSON.message)
                    }
                })
            });
        });
    </script>
@stop
