<?php

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/', 'HomeController@index');
    Route::get('/home', 'HomeController@index')->name('home');
    
    Route::prefix('estoque')->group(function () {
        Route::get('/', 'EstoquesController@index')->name('estoque.index');
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
        Route::get('/', 'LancamentosController@index')->name('lancamentos.listar');
        Route::get('criar', 'LancamentosController@create')->name('lancamentos.criar');
        Route::post('criar', 'LancamentosController@store')->name('lancamentos.salvar');
        Route::get('{id}/editar', 'LancamentosController@edit')->name('lancamentos.editar');
        Route::put('{id}/editar', 'LancamentosController@update')->name('lancamentos.atualizar');
        Route::delete('{id}/deletar', 'LancamentosController@destroy')->name('lancamentos.deletar');
    });
});
