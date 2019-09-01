@extends('adminlte::page')

@section('title', 'Cadastro de produtos')

@section('content_header')
    <h1>Cadastro de <small>produtos</small></h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('home') }}"><i class="fa fa-home"></i> Home</a>
        </li>
        <li>
            <a href="{{ route('produtos.listar') }}"><i class="fa fa-home"></i> Produtos</a>
        </li>
        <li class="active">
            <i class="fa fa-home"></i> Cadastro</a>
        </li>
    </ol>
@stop

@section('content')
    @include('partials.back-button', ['url' => 'produtos.listar'])

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Cadastro de produto</h3>
                </div>

                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-12">
                            {!! Form::open(['route' => ['produtos.criar']]) !!}
                                @include('produtos._form')
                            {!! Form::close() !!}
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
