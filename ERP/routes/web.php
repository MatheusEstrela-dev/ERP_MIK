<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdutoController; // Adicione esta linha

Route::get('/', function () {
    return view('welcome');
});

Route::resource('produtos', ProdutoController::class);
