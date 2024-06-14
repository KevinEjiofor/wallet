<?php

;

use App\Models\User;
use App\Models\Wallet;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WalletController extends Controller
{
    public function getUsers()
    {
        $users = User::all();
        return response()->json($users);
    }

    public function getWallets()
    {
        $wallets = Wallet::all();
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


