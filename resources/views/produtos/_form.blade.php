{!! Form::token() !!}

<div class="row">
    <div class="col-xs-6">
        <div class="form-group">
            {!! Form::label('nome', 'Nome') !!}
            {!! Form::text('nome', $produto->nome ?? null, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="col-xs-6">
        <div class="form-group">
            {!! Form::label('preco', 'Preço') !!}
            {!! Form::text('preco', $produto->preco ?? null, ['class' => 'form-control']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <button type="submit" class="btn btn-primary">
            <i class="fa fa-save"></i> Salvar
        </button>
    </div>
</div>
