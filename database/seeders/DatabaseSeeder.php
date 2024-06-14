<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Wallet;
use App\Models\WalletType;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Create users
        User::factory()->count(10)->create();

        // Create wallet types
        WalletType::factory()->count(5)->create();

        // Retrieve all user IDs and wallet type IDs
        $userIds = User::pluck('id');
        $walletTypeIds = WalletType::pluck('id');

        // Create wallets for each user and associate with a random wallet type
        foreach ($userIds as $userId) {
            Wallet::factory()->count(2)->create([
                'user_id' => $userId,
                'wallet_type_id' => $walletTypeIds->random(),
            ]);
        }
    }
}
