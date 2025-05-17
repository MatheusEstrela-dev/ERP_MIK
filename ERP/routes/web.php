<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\EstoqueController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\CupomController;

// Rotas web completas com views (index, create, store, edit, update, destroy)
Route::resource('usuarios', UsuarioController::class);
Route::resource('produtos', ProdutoController::class);
Route::resource('estoques', EstoqueController::class);
Route::resource('pedidos', PedidoController::class);
Route::resource('cupoms', CupomController::class);

// Redirecionar a home para a lista de produtos
Route::get('/', function () {
    return redirect()->route('produtos.index');
});
