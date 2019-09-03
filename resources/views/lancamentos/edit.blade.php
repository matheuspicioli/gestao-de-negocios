@extends('adminlte::page')

@section('title', 'Edição de lançamento')

@section('content_header')
    <h1>Edição de <small>lançamento</small></h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('home') }}"><i class="fa fa-home"></i> Home</a>
        </li>
        <li>
            <a href="{{ route('lancamentos.listar') }}"><i class="fa fa-home"></i> Lançamentos</a>
        </li>
        <li class="active">
            <i class="fa fa-home"></i> Edição</a>
        </li>
    </ol>
@stop

@section('content')
    @include('partials.back-button', ['url' => 'lancamentos.listar'])

    <div class="row">
        <div class="col-xs-12">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">Edição</h3>
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
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-12">
                                {!! Form::open(['route' => ['lancamentos.atualizar', $lancamento->id]]) !!}
                                    {!! method_field('PUT') !!}
                                    @include('lancamentos._form')
                                {!! Form::close() !!}
                            </div>
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

        })
    </script>
@stop
