<?php

namespace Database\Factories;

use App\Models\WalletType;
use Illuminate\Database\Eloquent\Factories\Factory;

class WalletTypeFactory extends Factory
{
    protected $model = WalletType::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'minimum_balance' => 0.00,
            'monthly_interest_rate' => 0.00,
        ];
    }
}
