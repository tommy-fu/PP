<?php

namespace App\Domain\Brand;

use App\Domain\Brand\Elements\Buttons\IconButton;
use App\Domain\Brand\Elements\Custom\IphoneXColor;
use App\Domain\ColorThemes\Elements\Base;
use App\Domain\ColorThemes\Elements\Base\Badge;
use App\Domain\ColorThemes\Elements\Base\BodyInlineLink;
use App\Domain\ColorThemes\Elements\Base\BodyText;
use App\Domain\ColorThemes\Elements\Base\FooterLink;
use App\Domain\ColorThemes\Elements\Base\Input;
use App\Domain\ColorThemes\Elements\Base\Link;
use App\Domain\ColorThemes\Elements\Base\NavButton;
use App\Domain\ColorThemes\Elements\Base\NavButtonOutlined;
use App\Domain\ColorThemes\Elements\Base\NavLink;
use App\Domain\ColorThemes\Elements\Base\ButtonOutlined;
use App\Domain\ColorThemes\Elements\Base\SolidButton;
use App\Domain\ColorThemes\Elements\Base\Text;
use App\Domain\ColorThemes\Elements\BorderRadius;
use App\Domain\ColorThemes\Elements\Card;
use App\Domain\ColorThemes\Elements\CardBody;
use App\Domain\ColorThemes\Elements\ColumnGutters;
use App\Domain\ColorThemes\Elements\Section;
use App\Domain\ColorThemes\Elements\SocialMediaIcon;

class BrandVariables
{
    /**
     * @var string[]
     */
    public static $styleVariables = [
        Section::class,
        Base::class,
        Text::class,
        BodyText::class,
        NavButton::class,
        SolidButton::class,
        IconButton::class,
        Input::class,
        BodyInlineLink::class,
        ButtonOutlined::class,
        NavButtonOutlined::class,
        Link::class,
        NavLink::class,
        FooterLink::class,
        BorderRadius::class,
        Badge::class,
        ColumnGutters::class,
        Card::class,
        CardBody::class,
        SocialMediaIcon::class,
	    IphoneXColor::class
    ];

    //Todo: Split this in order to prevent duplicates
    public static function getBrand2(): array
    {
        return collect(self::$styleVariables)
            ->map(function ($variable) {
                if (method_exists($variable, 'makeStyle')) {
                    return $variable::makeStyle();
                }

                return [];
            })
            ->mapWithKeys(function ($a) {
                return $a;
            })->toArray();
    }
}
