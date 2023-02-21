<?php

namespace Tests\Domain\ColorSchemeBuilder;

use App\Domain\Brand\BrandVariables;
use App\Domain\ColorThemes\ColorScheme;
use App\Domain\ColorThemes\Elements\Base\Colorable;
use App\Domain\Users\User;
use App\SchemeColorFormula;
use Tests\DbTestCase;

class SchemeColorFormulaTest extends DbTestCase
{
    /** @test */
    public function it_can_show_default_edit_page()
    {
        $this->withoutExceptionHandling();

        $user = Factory(User::class)->create([
            'email' => 'vi.man93@gmail.com',
        ]);

        $this->be($user);

        $schemeColorFormula = SchemeColorFormula::factory()->create();

        $this->get(Route('scheme-color-formula.edit', ['scheme_color_formula' => $schemeColorFormula]))
            ->assertStatus(200);
    }

    /** @test */
    public function it_can_show_edit_button_page()
    {
        $this->withoutExceptionHandling();

        $user = Factory(User::class)->create([
            'email' => 'vi.man93@gmail.com',
        ]);

        $this->be($user);

        $schemeColorFormula = SchemeColorFormula::factory()->create();

        collect(BrandVariables::$styleVariables)
            ->filter(function ($variable) {
                return is_subclass_of($variable, Colorable::class);
            })
            ->each(function ($variable) use ($schemeColorFormula) {
                $this->get(Route('scheme-color-formula.edit', ['scheme_color_formula' => $schemeColorFormula]) . '?type=' . (new $variable)->getColorFormulaKey())
                    ->assertStatus(200);
            });
    }
	
	
	/** @test */
	public function it_can_show_edit_color_scheme_page()
	{
		$this->withoutExceptionHandling();
		
		$user = Factory(User::class)->create([
			'email' => 'vi.man93@gmail.com',
		]);
		
		$this->be($user);
		
		$colorScheme = Factory(ColorScheme::class)->create();
		
		collect(BrandVariables::$styleVariables)
			->filter(function ($variable) {
				return is_subclass_of($variable, Colorable::class);
			})
			->each(function ($variable) use ($colorScheme) {
				$response = $this->get(Route('color-schemes.edit', ['color_scheme' => $colorScheme]) . '?type=' . (new $variable)->getColorFormulaKey());
				
				$response->assertStatus(200);
				
				foreach (collect((new $variable)->items())->pluck('key') as $item) {
					$response->assertSee($item);
				}
			});
	}
}
