<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['name', 'email'];

    public function wallets()
    {
        return $this->hasMany(Wallet::class);
    }

    public function createWallets()
    {
        $mainAccountNumber = '2' . str_pad(mt_rand(1, 999999999), 9, '0', STR_PAD_LEFT);
        $escrowAccountNumber = '3' . str_pad(mt_rand(1, 999999999), 9, '0', STR_PAD_LEFT);

        // Create main account wallet for the user
        $this->wallets()->create([
            'wallet_type_id' => WalletType::MAIN_ACCOUNT,
            'account_number' => $mainAccountNumber,
            'balance' => 0.00,
            'pin' => mt_rand(1000, 9999),
        ]);

        // Create escrow account wallet for the user
        $this->wallets()->create([
            'wallet_type_id' => WalletType::ESCROW_ACCOUNT,
            'account_number' => $escrowAccountNumber,
            'balance' => 0.00,
            'pin' => mt_rand(1000, 9999),
        ]);
    }
}
