{!! Form::token() !!}

<div class="row">
    {!! Form::hidden('usuario_id', Auth::user()->id) !!}
    <div class="col-xs-1">
        <div class="form-group">
            {!! Form::label('quantidade', 'Quantidade') !!}
            {!! Form::number('quantidade', 1, ['class' => 'form-control', 'max' => '50', 'min' => '1']) !!}
        </div>
    </div>

    <div class="col-xs-3">
        <div class="form-group">
            {!! Form::label('items[]', 'Item') !!}
            {!! Form::select('items[]', $itens, $itensSelected ?? null, ['class' => 'form-control', 'id' => 'items[]', 'multiple' => 'multiple']) !!}
        </div>
    </div>

    <div class="col-xs-2">
        {!! Form::label('tipo', 'Tipo do lançamento') !!}
        <div class="form-group" style="">
            <label class="radio-inline" for="tipo-entrada">
                {!! Form::radio('tipo', 'ENTRADA', true, ['id' => 'tipo-entrada']) !!}
                Entrada
            </label>
            <label class="radio-inline" for="tipo-saida">
                {!! Form::radio('tipo', 'SAIDA', false, ['id' => 'tipo-saida']) !!}
                Saída
            </label>
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
