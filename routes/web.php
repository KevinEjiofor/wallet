<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WalletController;

Route::get('/users', [WalletController::class, 'getUsers']);
Route::get('/wallets', [WalletController::class, 'getAllWallets']);
Route::get('/wallet/{wallet_id}', [WalletController::class, 'getWalletDetails']); // Corrected route
Route::get('/user/{user_id}', [WalletController::class, 'getPersonFullDetails']); // Route for getting user details
Route::post('/wallet/transfer', [WalletController::class, 'transferMoney']);
