<?php

namespace Tests\Domain\ColorThemes\Elements;

use App\Domain\ColorThemes\ColorScheme;
use App\Domain\ColorThemes\Elements\LogoFill;
use Tests\DbTestCase;

class LogoFillTest extends DbTestCase
{
    /** @test */
    public function it_can_get_a_color_fill()
    {
        app()->singleton('colors', function () {
            return Factory(ColorScheme::class)->create([
                'colors' => [
                    'text' => 'yellow',
                ],
            ])['colors'];
        });

        $cssStyle = LogoFill::makeCssStyle();

        $this->assertEquals('.logo-fill path', $cssStyle->getSelector());
        $this->assertEquals('yellow', $cssStyle->getStyleValueByKey('fill'));
    }
}
