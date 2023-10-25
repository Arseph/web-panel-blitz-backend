<?php

namespace Database\Factories;

use App\Models\WebsitePage;
use Illuminate\Database\Eloquent\Factories\Factory;

class WebsitePageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = WebsitePage::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $pageNames = [
            'Home',
            'About',
            'Contact Us',
            'Cart',
            'Shop',
            'API',
            'Products',
            'Company',
            'Who We Are',
            'Goals',
            'Developers',
            'Partners',
            'Store',
            'Jobs',
            'Support',
            'Download',
            'Features',
            'News',
            'Manual',
            'License',
            'Donate',
        ];

        return [
            'website_id' => 1,
            'name' => $this->faker->randomElement($pageNames),
        ];
    }
}
