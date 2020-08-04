<?php

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/', 'HomeController@index');
    Route::get('/home', 'HomeController@index')->name('home');

    Route::prefix('estoque')->group(function () {
        Route::get('/', 'EstoquesController@index')->name('estoque.index');
    });

    Route::prefix('relatorios')->group(function () {
        Route::get('/', 'RelatoriosController@index')->name('relatorios.index');

        Route::prefix('estoque')->group(function () {
            Route::get('/', 'RelatoriosController@estoque')->name('relatorios.estoque.index');
            Route::get('/gerar', 'RelatoriosController@gerarRelatorioEstoque')->name('relatorios.estoque.gerar');
        });

        Route::prefix('lancamentos')->group(function () {
            Route::get('/', 'RelatoriosController@lancamento')->name('relatorios.lancamento.index');
            Route::get('/gerar', 'RelatoriosController@gerarRelatorioLancamento')->name('relatorios.lancamento.gerar');
        });
    });

    Route::prefix('itens')->group(function () {
        Route::get('/', 'ItensController@index')->name('itens.listar');
//        Route::get('criar', 'ItensController@create')->name('itens.criar');
        Route::post('criar', 'ItensController@store')->name('itens.salvar');
        Route::get('{id}/editar', 'ItensController@edit')->name('itens.editar');
        Route::put('{id}/editar', 'ItensController@update')->name('itens.atualizar');
        Route::delete('{id}/deletar', 'ItensController@destroy')->name('itens.deletar');
    });

    Route::prefix('lancamentos')->group(function () {
        Route::get('/', 'EntriesController@index')->name('lancamentos.listar');
        Route::get('criar', 'EntriesController@create')->name('lancamentos.criar');
        Route::post('criar', 'EntriesController@store')->name('lancamentos.salvar');
        Route::get('{id}/editar', 'EntriesController@edit')->name('lancamentos.editar');
        Route::put('{id}/editar', 'EntriesController@update')->name('lancamentos.atualizar');
        Route::delete('{id}/deletar', 'EntriesController@destroy')->name('lancamentos.deletar');
    });
});
