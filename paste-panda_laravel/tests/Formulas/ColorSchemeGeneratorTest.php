<?php

namespace Tests\Formulas;

use App\ColorContrast\ColorItemV2;
use Tests\TestCase;

class ColorSchemeGeneratorTest extends TestCase
{
    /** @test */
    public function it_can_add_hue()
    {
        $color = new ColorItemV2('1592FF');
        $color->addHue(-25);

        $this->assertEquals(183, $color->getHue());
    }

    /** @test */
    public function it_can_add_a_hue_which_makes_the_result_negative()
    {
        $color = new ColorItemV2('1592FF');
        $color->addHue(-218);

        $this->assertEquals(350, $color->getHue());
    }

    /** @test */
    public function it_get_correct_hues()
    {
        $color = new ColorItemV2('E3F751');

        $this->assertEquals(67, $color->getHue());
        $this->assertEquals(67, $color->getSaturation());
        
        $this->assertEquals(42, $color->addHue(-25)->getHue());
        $this->assertEquals(67, $color->getSaturation());

        $this->assertEquals(17, $color->addHue(-25)->getHue());
        $this->assertEquals(352, $color->addHue(-25)->getHue());
    }
}
