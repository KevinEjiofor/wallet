<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class WalletController extends Controller
{

   
    public function getUsers()
    {
        $users = User::all();
        return response()->json($users);
    }

    public function getAllWallets()
    {
        $wallets = Wallet::with(['user', 'walletType'])->get();
        
        if ($wallets->isEmpty()) {
            return response()->json(['error' => 'No wallets found'], 404);
        }

        return response()->json($wallets);
    }

    public function getWalletDetails($wallet_id)
    {
        $wallet = Wallet::with(['user', 'walletType'])->find($wallet_id);

        if (!$wallet) {
            return response()->json(['error' => 'Wallet not found'], 404);
        }

        return response()->json($wallet);
    }


    public function getPersonFullDetails($user_id)
{
    // Check if the user ID is either 1 or 2
    if ($user_id != 1 && $user_id != 2) {
        return response()->json(['error' => 'User not found'], 404);
    }

    // Retrieve the user based on the ID
    $user = User::with(['wallets' => function ($query) {
        $query->with(['user', 'walletType', 'transactions']); // Eager load related models
    }])->find($user_id);

    // If user not found, return error
    if (!$user) {
        return response()->json(['error' => 'User not found'], 404);
    }

    // Calculate total balance across all user's wallets
    $totalBalance = $user->wallets->sum('balance');

    // Additional calculations or data manipulation as needed

    return response()->json([
        'user' => $user,
        'total_balance' => $totalBalance,
        // Include other relevant data about the user or their wallets
    ]);
}



public function transferMoney(Request $request)
{
    $request->validate([
        'from_wallet_id' => 'required|exists:wallets,id',
        'to_wallet_id' => 'required|exists:wallets,id',
        'amount' => 'required|numeric|min:0.01',
    ]);

    $from_wallet = Wallet::find($request->from_wallet_id);
    $to_wallet = Wallet::find($request->to_wallet_id);
    $amount = $request->amount;

    if ($from_wallet->balance < $amount) {
        return response()->json(['error' => 'Insufficient funds'], 400);
    }

    DB::transaction(function () use ($from_wallet, $to_wallet, $amount) {
        $from_wallet->balance -= $amount;
        $to_wallet->balance += $amount;

        $from_wallet->save();
        $to_wallet->save();

        Transaction::create([
            'from_wallet_id' => $from_wallet->id,
            'to_wallet_id' => $to_wallet->id,
            'amount' => $amount,
        ]);
    });

    return response()->json(['message' => 'Transfer successful']);
}
}
