<?php

namespace Database\Factories;

use App\Fragment;
use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;

class FragmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Fragment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
	        'name' => $this->faker->name(),
	        'html' => $this->faker->randomHtml(),
	        'css' => 'css',
	        'javascript' => 'js',
        ];
    }
}
