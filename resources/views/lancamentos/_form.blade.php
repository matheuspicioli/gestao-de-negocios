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

    {{-- ===== LISTA ITENS ===== --}}
    <div class="col-xs-6">
        <table class="table table-bordered table-hover">
            <thead>
            <tr>
                <th>Quantidade</th>
                <th>Item</th>
                <th>Valor unitário</th>
                <th>Valor</th>
                <th>Ações</th>
            </tr>
            </thead>
            <tbody id="wrapper">
            </tbody>
            <tfoot>
            <tr>
                <th colspan="3" style="text-align: right;">TOTAL</th>
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
