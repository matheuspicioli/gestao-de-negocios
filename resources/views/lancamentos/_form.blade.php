<div class="row">
    {{-- ===== FORMULÁRIO ===== --}}
    {!! Form::hidden('user_id', Auth::user()->id, ['id' => 'user_id']) !!}
    {!! Form::hidden('type', 'SAIDA', ['id' => 'type']) !!}
    <div class="col-xs-1">
        <div class="form-group">
            {!! Form::label('quantidade', 'Quantidade') !!}
            {!! Form::number('quantidade', 1, ['class' => 'form-control', 'max' => '50', 'min' => '1', 'id' => 'quantidade']) !!}
        </div>
    </div>

    <div class="col-xs-2">
        <div class="form-group">
            {!! Form::label('item', 'Item') !!}
            {!! Form::select('item', $itens, $itensSelected ?? null, ['class' => 'form-control select2', 'id' => 'item']) !!}
        </div>
    </div>

    <div class="col-xs-1">
        <div class="form-group">
            {!! Form::label('productValue', 'Valor do produto') !!}
            {!! Form::text('productValue', null, ['class' => 'form-control', 'id' => 'productValue', 'placeholder' => '0.00', 'readonly' => 'readonly']) !!}
        </div>
    </div>

    <div class="col-xs-1">
        <div class="form-group">
            {!! Form::label('totalValue', 'Valor total') !!}
            {!! Form::text('totalValue', null, ['class' => 'form-control', 'id' => 'totalValue', 'placeholder' => '0.00', 'readonly' => 'readonly']) !!}
        </div>
    </div>

    <div class="col-xs-1">
        <div class="form-group">
            {!! Form::label('valueRecieve', 'Valor recebido') !!}
            {!! Form::text('valueRecieve', null, ['class' => 'form-control', 'id' => 'valueRecieve', 'placeholder' => '0.00']) !!}
        </div>
    </div>

    <div class="col-xs-1">
        <div class="form-group">
            {!! Form::label('change', 'Troco') !!}
            {!! Form::text('change', null, ['class' => 'form-control', 'id' => 'change', 'placeholder' => '0.00', 'readonly' => 'readonly']) !!}
        </div>
    </div>

    <div class="col-xs-1">
        <div class="form-group">
            <button type="button" class="btn btn-xs btn-success" id="adicionar-item">
                <i class="fa fa-plus"></i> Adicionar
            </button>
        </div>
    </div>

    <div class="col-xs-2">
        <div class="form-group">
            {!! Form::label('payment_id', 'Pagamento') !!}
            {!! Form::select('payment_id', $payments, null, ['class' => 'form-control select2', 'id' => 'payment_id']) !!}
        </div>
    </div>
    {{-- ===== FORMULÁRIO ===== --}}
</div>

<div class="row">
    {{-- ===== LISTA ITENS ===== --}}
    <div class="col-xs-12">
        <table class="table table-bordered table-hover">
            <thead>
            <tr>
                <th>Quantidade</th>
                <th>Item</th>
                <th>Valor unitário</th>
                <th>Valor recebido</th>
                <th>Troco</th>
                <th>Valor final</th>
                <th>Ações</th>
            </tr>
            </thead>
            <tbody id="wrapper">
            </tbody>
            <tfoot>
            <tr>
                <th colspan="5" style="text-align: right;">LANÇAMENTO TOTAL</th>
                <td colspan="1" style="text-align: left;" id="valor-total"></td>
            </tr>
            </tfoot>
        </table>
    </div>
    {{-- ===== LISTA ITENS ===== --}}
</div>

<div class="row">
    <div class="col-xs-12">
        <button type="button" class="btn btn-primary pull-right" id="salvar-lancamento">
            <i class="fa fa-save"></i> Salvar
        </button>
    </div>
</div>

<template>

</template>
