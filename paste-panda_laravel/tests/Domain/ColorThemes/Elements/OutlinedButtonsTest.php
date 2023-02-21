<?php

namespace Tests\Domain\ColorThemes\Elements;

use App\Domain\ColorThemes\Colors;
use App\Domain\ColorThemes\Elements\Modifiers\OutlinedButtonModifiers;
use App\Domain\ColorThemes\Elements\SolidButtonColorModifiers;
use Tests\TestCase;

class OutlinedButtonsTest extends TestCase
{
    /**
     * @test
     * @dataProvider modifiers()
     */
    public function it_can_set_correct_button_color_modifiers_for_darker_color($modifier)
    {
        Colors::initialize([
            $modifier => '#51A8FF',
            'h1' => '#B8B8B8',
        ]);

        $modifiers = SolidButtonColorModifiers::handle();

        $this->assertCount(4, $modifiers->getSubClasses());

        $modifier = $modifiers->getSubClasses()->first(function ($item) use ($modifier) {
            return $item->getSelector() == '.is-' . $modifier;
        });

        $this->assertNotNull($modifier);
        $this->assertEquals('#51A8FF !important', $modifier->getStyleByKey('background'));
        $this->assertEquals('#FFFFFF !important', $modifier->getStyleByKey('color'));
    }

    /**
     * @test
     * @dataProvider modifiers()
     */
    public function it_can_set_correct_button_color_modifiers_for_lighter_color($modifier)
    {
        Colors::initialize([
            $modifier => '#FFFFFF',
            'h1' => '#B8B8B8',
        ]);

        $modifiers = SolidButtonColorModifiers::handle();

        $this->assertCount(4, $modifiers->getSubClasses());

        $modifier = $modifiers->getSubClasses()->first(function ($item) use ($modifier) {
            return $item->getSelector() == '.is-' . $modifier;
        });

        $this->assertNotNull($modifier);
        $this->assertEquals('#FFFFFF !important', $modifier->getStyleByKey('background'));
        $this->assertEquals('#B8B8B8 !important', $modifier->getStyleByKey('color'));
    }

    /**
     * @test
     * @dataProvider modifiers()
     */
    public function it_can_set_correct_outlined_button_modifier_colors($modifier)
    {
        Colors::initialize([
            $modifier => '#FFFFFF',
            'h1' => '#B8B8B8',
        ]);

        $modifiers = OutlinedButtonModifiers::handle();

        $this->assertCount(4, $modifiers->getSubClasses()->first()->getSubClasses());

        $isOutlined = $modifiers->getSubClasses()->first(function ($item) use ($modifier) {
            return $item->getSelector() == '.is-outlined';
        });

        $this->assertNotNull($isOutlined);

        $modifier = $modifiers->getSubClasses()->first()->getSubClasses()->first(function ($item) use ($modifier) {
            return $item->getSelector() == '.is-' . $modifier;
        });

        $this->assertNotNull($modifier);
        $this->assertEquals('transparent !important', $modifier->getStyleByKey('background'));
        $this->assertEquals('#B8B8B8 !important', $modifier->getStyleByKey('color'));
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
    
}
