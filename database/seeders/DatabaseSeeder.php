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

        // Generate transaction statuses
        \App\Models\TransactionStatus::insert([
            [
                'id' => 1,
                'name' => 'Unpaid'
            ],
            [
                'id' => 2,
                'name' => 'Paid'
            ],
            [
                'id' => 3,
                'name' => 'Accepted'
            ],
            [
                'id' => 4,
                'name' => 'Sent'
            ],
            [
                'id' => 5,
                'name' => 'Failed'
            ],
            [
                'id' => 6,
                'name' => 'Success'
            ],
        ]);
    }
}
