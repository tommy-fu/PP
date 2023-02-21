<?php

namespace Tests\Domain\ColorThemes\Elements;

use App\Domain\ColorThemes\Elements\Modifiers\BorderColor;
use App\Domain\ColorThemes\Elements\Modifiers\TextModifier;
use App\Domain\ColorThemes\Elements\Texts\FontWeight;
use App\Domain\ColorThemes\Elements\Utility\Display;
use App\Domain\ColorThemes\Elements\Utility\Flex\AlignContent;
use App\Domain\ColorThemes\Elements\Utility\Flex\AlignItems;
use App\Domain\ColorThemes\Elements\Utility\Flex\AlignSelf;
use App\Domain\ColorThemes\Elements\Utility\Flex\FlexDirection;
use App\Domain\ColorThemes\Elements\Utility\Flex\FlexGrow;
use App\Domain\ColorThemes\Elements\Utility\Flex\FlexShrink;
use App\Domain\ColorThemes\Elements\Utility\Flex\FlexWrap;
use App\Domain\ColorThemes\Elements\Utility\Flex\JustifyContent;
use App\Domain\ColorThemes\Elements\Utility\Flex\Order;
use App\Domain\ColorThemes\Elements\Utility\Height;
use App\Domain\ColorThemes\Elements\Utility\MinHeight;
use App\Domain\ColorThemes\Elements\Utility\Opacity;
use App\Domain\ColorThemes\Elements\Utility\Overflow;
use App\Domain\ColorThemes\Elements\Utility\Position;
use App\Domain\ColorThemes\Elements\Utility\Spacing\MarginLeft;
use App\Domain\ColorThemes\Elements\Utility\Spacing\MarginRight;
use App\Domain\ColorThemes\Elements\Utility\Typography\TextAlign;
use App\Domain\ColorThemes\Elements\Utility\Typography\TextTransform;
use App\Domain\ColorThemes\Elements\Utility\Width;
use Illuminate\Support\Str;
use PHPUnit\Framework\TestCase;

class SimpleCssStyleFactoryTest extends TestCase
{
    /**
     * @test
     * @dataProvider items()
     */
    public function it_can_generate_css_styles_using_factories($item, $property)
    {
        $className = Str::random(5);
	    $value = Str::random(5);
        $cssStyle = $item::make($className, $value);
        $cssStyle->getSelector() == '.' . $className;
        $this->assertEquals($value, $cssStyle->getStyleByKey($property));
    }

    public function items(): array
    {
        return [
            [BorderColor::class, 'border-color'],
            [TextModifier::class, 'color'],
            [FontWeight::class, 'font-weight'],
	        
            [AlignContent::class, 'align-content'],
            [AlignItems::class, 'align-items'],
            [AlignSelf::class, 'align-self'],
            [FlexDirection::class, 'flex-direction'],
            [FlexGrow::class, 'flex-grow'],
            [FlexShrink::class, 'flex-shrink'],
            [FlexWrap::class, 'flex-wrap'],
            [JustifyContent::class, 'justify-content'],
            [Order::class, 'order'],
	        
            [MarginLeft::class, 'margin-left'],
            [MarginRight::class, 'margin-right'],
	        
            [TextAlign::class, 'text-align'],
            [TextTransform::class, 'text-transform'],
	        
            [Display::class, 'display'],
            [Height::class, 'height'],
            [MinHeight::class, 'min-height'],
            [Opacity::class, 'opacity'],
            [Overflow::class, 'overflow'],
            [Position::class, 'position'],
            [Width::class, 'width'],
	        
	        
        ];
    }
}
