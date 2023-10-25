<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seeds = [
            [
                'name' => 'Test Account',
                'email' => 'test@email.com',
                'password' => bcrypt('testDev1'),
            ]
        ];

        foreach ($seeds as $seed) {
            User::factory()->create($seed);
        }
        
        User::factory()->count(9)->create();
    }
}
