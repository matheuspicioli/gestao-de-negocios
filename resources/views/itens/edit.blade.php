@extends('adminlte::page')

@section('title', 'Edição de item')

@section('content_header')
    <h1>Edição de <small>item</small></h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('home') }}"><i class="fa fa-home"></i> Home</a>
        </li>
        <li>
            <a href="{{ route('itens.listar') }}"><i class="fa fa-home"></i> Item</a>
        </li>
        <li class="active">
            <i class="fa fa-home"></i> Edição</a>
        </li>
    </ol>
@stop

@section('content')
    @include('partials.back-button', ['url' => 'itens.listar'])

    <div class="row">
        <div class="col-xs-12">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">Edição</h3>
                </div>

                <div class="box-body">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-12">
                                {!! Form::open(['route' => ['itens.atualizar', $item->id]]) !!}
                                    {!! method_field('PUT') !!}
                                    @include('itens._form')
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
