<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagamentosController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::controller(PagamentosController::class)->group(function () {
    Route::get('/pagamento/boleto', 'boleto');
    Route::get('/pagamento/pix', 'pix');
    Route::get('/pagamento/cartao', 'cartao');
    Route::post('/pagamento/processa_cartao', 'ProcessaCartao');
});