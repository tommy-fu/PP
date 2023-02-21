<?php

namespace Tests\Feature\Brands\Actions;

use App\Domain\Brand\Actions\UpdateStyle;
use App\Domain\Brand\Models\Brand;
use Tests\DbTestCase;

class UpdateStyleTest extends DbTestCase
{
    /** @test */
    public function it_can_update_a_style()
    {
        $brand = Factory(Brand::class)->create([
            'variables' => [
                'h1' => [
                    'base_styles' => [
                        'font-family' => 'Foobar',
                        'text-transform' => 'Uppercase',
                    ],
                    'mobile_styles' => [
                        'font-size' => '14px',
                    ],
                    'tablet_styles' => [
                        'font-size' => '24px',
                    ],
                    'desktop_styles' => [
                        'font-size' => '36px',
                    ],
                ],
            ],
        ]);

        $variables = $brand->variables;

        $variables['h1']['base_styles']['font-family'] = 'Inter';

        $updateStyle = new UpdateStyle();

        $updateStyle->execute($brand, [
            'variables' => $variables,
        ]);

        $this->assertEquals('Inter', $brand['variables']['h1']['base_styles']['font-family']);
    }
}
