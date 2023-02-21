<?php

namespace Tests\Domain\ColorThemes\Elements\Base;

use App\Domain\ColorThemes\Elements\Base;
use App\Domain\ColorThemes\Elements\Base\SolidButton;
use App\Domain\ColorThemes\Elements\Base\Text;
use PHPUnit\Framework\TestCase;

class ColorableTraitTest extends TestCase
{
    /** @test
     * @dataProvider values()
     */
    public function it_can_generate_correct_formula_keys($class, $variables)
    {
        $text = new $class();

        $formulaKeys = $text::getFormulaKeys();

        foreach ($variables as $variable) {
            $this->assertContains($variable, $formulaKeys);
        }
    }

    public function values() : array
    {
        return [
            [SolidButton::class, ['button-background', 'button-color', 'button-border-color']],
            [Base::class, ['text', 'primary', 'secondary']],
            [Text::class, ['mega', 'h1', 'h2']],
        ];
    }
}
