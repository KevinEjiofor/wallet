<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\WalletController;

Route::get('/users', [WalletController::class, 'getUsers']);
Route::get('/wallets', [WalletControler::class, 'getWallets']);
Route::get('/wallet/{wallet_id}', [WalletControler::class, 'getWalletDetails']);
Route::post('/wallet/transfer', [WalletControler::class, 'transferMoney']);


Route::get('/', function () {
    return view('welcome');
});
