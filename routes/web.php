<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\WalletController;

Route::get('/users', [WalletController::class, 'getUsers']);
Route::get('/wallets', [WalletController::class, 'getWallets']);
Route::get('/wallet/{wallet_id}', [WalletController::class, 'getWalletDetails']);
Route::post('/wallet/transfer', [WalletController::class, 'transferMoney']);


Route::get('/', function () {
    return view('welcome');
});
