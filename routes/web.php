<?php

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/', 'HomeController@index');
    Route::get('/home', 'HomeController@index')->name('home');
    
    Route::prefix('produtos')->group(function () {
        Route::get('/', 'ProdutosController@index')->name('produtos.listar');
        Route::get('criar', 'ProdutosController@create')->name('produtos.criar');
        Route::post('criar', 'ProdutosController@store')->name('produtos.salvar');
        Route::get('{id}/editar', 'ProdutosController@edit')->name('produtos.editar');
        Route::put('{id}/editar', 'ProdutosController@update')->name('produtos.atualizar');
        Route::delete('{id}/deletar', 'ProdutosController@destroy')->name('produtos.deletar');
    });
    
    Route::prefix('servicos')->group(function () {
        Route::get('/', 'ServicosController@index')->name('servicos.listar');
        Route::get('criar', 'ServicosController@create')->name('servicos.criar');
        Route::post('criar', 'ServicosController@store')->name('servicos.salvar');
        Route::get('{id}/editar', 'ServicosController@edit')->name('servicos.editar');
        Route::put('{id}/editar', 'ServicosController@update')->name('servicos.atualizar');
        Route::delete('{id}/deletar', 'ServicosController@destroy')->name('servicos.deletar');
    });
    
    Route::prefix('lancamentos')->group(function () {
        Route::get('/', 'LancamentosController@index')->name('lancamentos.listar');
    });
});
