<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\MarketRate;
use App\Models\ExchangeRate;

class MarketRateSeeder extends Seeder
{
    public function run(): void
    {
        MarketRate::updateOrCreate(['type' => 'gold'], [
            'unit' => 'tola',
            'price' => 245000,
            'currency' => 'PKR',
            'source' => 'fallback'
        ]);

        MarketRate::updateOrCreate(['type' => 'silver'], [
            'unit' => 'tola',
            'price' => 3100,
            'currency' => 'PKR',
            'source' => 'fallback'
        ]);

        $currencies = [
            'USD' => 278.50,
            'SAR' => 74.20,
            'AED' => 75.80,
            'GBP' => 355.10,
            'EUR' => 305.40,
            'CAD' => 205.20,
        ];

        foreach ($currencies as $code => $rate) {
            ExchangeRate::updateOrCreate(['currency_code' => $code], [
                'currency_name' => $code,
                'rate_to_pkr' => $rate
            ]);
        }
    }
}
