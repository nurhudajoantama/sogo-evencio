<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // Generate 3 payment method categories
        \App\Models\PaymentMethodCategory::insert([
            [
                'id' => 1,
                'name' => 'Bank'
            ],
            [
                'id' => 2,
                'name' => 'E-Wallet'
            ],
            [
                'id' => 3,
                'name' => 'QR Code'
            ],
        ]);
    }
}
