<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    // Define fillable attributes
    protected $fillable = ['user_id', 'type', 'balance', 'account_number', 'pin'];

    // Define relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function walletType()
    {
        return $this->belongsTo(WalletType::class, 'type', 'name');
    }
}
