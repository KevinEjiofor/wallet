<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Wallet;
use App\Models\WalletType;
use Illuminate\Database\Eloquent\Factories\Factory;

class WalletFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Wallet::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // Get a random user ID
        $user = User::inRandomOrder()->first();

        // Get a random wallet type
        $walletType = WalletType::inRandomOrder()->first();

        return [
            'user_id' => $user->id,
            'type' => $walletType->name,
            'balance' => $this->faker->randomFloat(2, 0, 1000), // Generate random balance between 0 and 1000
            'account_number' => $this->faker->numberBetween(1000000000, 9999999999), // Generate a 10-digit account number
            'pin' => $this->faker->numberBetween(1000, 9999), // Generate a 4-digit pin
        ];
    }
}
