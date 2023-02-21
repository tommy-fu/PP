<?php

namespace Tests\Domain\Brand\CssStyleFactory;

use App\Domain\ColorThemes\Colors;
use App\Domain\ColorThemes\Elements\SolidButtonColorModifiers;
use PHPUnit\Framework\TestCase;

class ButtonColorsModifiersTest extends TestCase
{
    /**
     * @test
     * @dataProvider modifiers()
     */
    public function it_can_generate_the_correct_modifier_button_colors_for_darker_colors($modifier)
    {
        Colors::initialize([
	        $modifier => '#0085FF',
            'h1' => '#B8B8B8',
        ]);

        $modifiers = SolidButtonColorModifiers::handle();

        $this->assertCount(4, $modifiers->getSubClasses());

        $modifier = $modifiers->getSubClasses()->first(function ($item) use($modifier){
            return $item->getSelector() == '.is-' . $modifier;
        });
        
        $this->assertNotNull($modifier);
        $this->assertEquals('#0085FF !important', $modifier->getStyleByKey('background'));
        $this->assertEquals('#FFFFFF !important', $modifier->getStyleByKey('color'));
    }

    public function modifiers() : array
    {
        return [
            ['primary'],
            ['secondary'],
            ['tertiary'],
            ['quaternary'],
        ];
    }

    /**
     * @test
     * @dataProvider modifiers
     */
    public function it_can_generate_the_correct_modifier_button_colors_for_light_modifier_colors($modifier)
    {
        Colors::initialize([
	        $modifier => '#FFACAC',
            'h1' => '#B8B8B8',
        ]);

        $modifiers = SolidButtonColorModifiers::handle();

        $this->assertCount(4, $modifiers->getSubClasses());

        $modifier = $modifiers->getSubClasses()->first(function ($item) use($modifier) {
            return $item->getSelector() == '.is-' . $modifier;
        });

        $this->assertNotNull($modifier);
        $this->assertEquals('#FFACAC !important', $modifier->getStyleByKey('background'));
        $this->assertEquals('#B8B8B8 !important', $modifier->getStyleByKey('color'));
    }
}
