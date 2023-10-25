<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Website;

class WebsiteSeeder extends Seeder
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
                'name' => 'CookyBakey'
            ],
            [
                'name' => 'Tuna Marina'
            ],
            [
                'name' => 'Spinny Wheelie'
            ],
            [
                'name' => 'Clickity Typey'
            ],
            [
                'name' => 'Ranch Boss'
            ],
        ];

        foreach($seeds as $seed){
            Website::factory()->hasPages(3)->hasDetails(1)->create($seed);
        }
    }
}
