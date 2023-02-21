<?php

namespace Database\Factories;

use App\Domain\Brand\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;

class BrandsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Brand::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
	        'name' => $this->faker->name,
	        'variables' => \App\Domain\Brand\BrandVariables::getBrand2()
        ];
    }
}
