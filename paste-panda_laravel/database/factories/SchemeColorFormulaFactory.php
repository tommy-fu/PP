<?php

namespace Database\Factories;

use App\Domain\SchemeFormula\SchemeFormulaBase;
use App\Models\Model;
use App\SchemeColorFormula;
use Illuminate\Database\Eloquent\Factories\Factory;

class SchemeColorFormulaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SchemeColorFormula::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
	        'name' => 'Test',
	        'colors' => SchemeFormulaBase::generateColorVariables(),
	        'type' => 0
        ];
    }
}
