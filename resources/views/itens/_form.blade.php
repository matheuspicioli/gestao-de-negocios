{!! Form::hidden('tipo', 'ENTRADA') !!}

<div class="row">
    <div class="col-xs-2">
        <div class="form-group">
            {!! Form::label('type', 'Tipo') !!}
            {!! Form::select('type', ['PRODUTO' => 'Produto', 'SERVICO' => 'Serviço'], 'PRODUTO', ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="col-xs-2">
        <div class="form-group">
            {!! Form::label('quantity', 'Quantidade') !!}
            {!! Form::number('quantity', $item->quantity ?? null, ['class' => 'form-control', 'id' => 'quantidade']) !!}
        </div>
    </div>

    <div class="col-xs-3">
        <div class="form-group">
            {!! Form::label('code', 'Código') !!}
            {!! Form::text('code', $item->code ?? null, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="col-xs-3">
        <div class="form-group">
            {!! Form::label('name', 'Nome') !!}
            {!! Form::text('name', $item->name ?? null, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="col-xs-2">
        <div class="form-group">
            {!! Form::label('value', 'valor') !!}
            {!! Form::text('value', $item->value ?? null, ['class' => 'form-control']) !!}
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
