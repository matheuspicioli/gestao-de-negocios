{!! Form::hidden('tipo', 'ENTRADA') !!}

<div class="row">
    <div class="col-xs-2">
        <div class="form-group">
            {!! Form::label('tipo', 'Tipo') !!}
            {!! Form::select('tipo', ['PRODUTO' => 'Produto', 'SERVICO' => 'Serviço'], 'PRODUTO', ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="col-xs-2">
        <div class="form-group">
            {!! Form::label('quantidade', 'Quantidade') !!}
            {!! Form::number('quantidade', $item->quantidade ?? null, ['class' => 'form-control', 'id' => 'quantidade']) !!}
        </div>
    </div>

    <div class="col-xs-3">
        <div class="form-group">
            {!! Form::label('codigo', 'Código') !!}
            {!! Form::text('codigo', $item->codigo ?? null, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="col-xs-3">
        <div class="form-group">
            {!! Form::label('nome', 'Nome') !!}
            {!! Form::text('nome', $item->nome ?? null, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="col-xs-2">
        <div class="form-group">
            {!! Form::label('preco', 'Preço') !!}
            {!! Form::text('preco', $item->preco ?? null, ['class' => 'form-control']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <button type="submit" class="btn btn-primary pull-right">
            <i class="fa fa-save"></i> Salvar
        </button>
    </div>
</div>
