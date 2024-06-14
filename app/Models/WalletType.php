<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WalletType extends Model
{
    use HasFactory;
    const MAIN_ACCOUNT = 1;
    const ESCROW_ACCOUNT = 2;

    protected $fillable = ['name', 'minimum_balance', 'monthly_interest_rate'];
}