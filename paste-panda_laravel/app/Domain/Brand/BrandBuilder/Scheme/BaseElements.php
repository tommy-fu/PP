<?php

namespace App\Domain\Brand\BrandBuilder\Scheme;

use App\Domain\Brand\BrandBuilder\BrandBuilderConfig;
use App\Domain\Brand\CssStyleBuilder\Composites\WrapperCssStyle;
use App\Domain\Brand\CssStyleBuilder\CssStyle;
use App\Domain\Brand\Elements\Buttons\IconButton;
use App\Domain\ColorThemes\Elements\Base\Badge;
use App\Domain\ColorThemes\Elements\Base\BodyText;
use App\Domain\ColorThemes\Elements\Base\ButtonIcon;
use App\Domain\ColorThemes\Elements\Base\Input;
use App\Domain\ColorThemes\Elements\Base\Link;
use App\Domain\ColorThemes\Elements\Base\NavButton;
use App\Domain\ColorThemes\Elements\Base\SolidButton;
use App\Domain\ColorThemes\Elements\Base\Text;
use App\Domain\ColorThemes\Elements\Base\TextBase;
use App\Domain\ColorThemes\Elements\BorderRadius;
use App\Domain\ColorThemes\Elements\HasTextGradient;
use App\Domain\ColorThemes\Elements\HrDivider;
use App\Domain\ColorThemes\Elements\VerticalDivider;
use Illuminate\Support\Collection;

class BaseElements
{
    private $elements = [
        NavButton::class,
        SolidButton::class,
        IconButton::class,
        Link::class,
        Input::class,
        Badge::class,
        Text::class,
        BodyText::class,
    ];

    private BrandBuilderConfig $brandBuilderConfig;

    public function handle(BrandBuilderConfig $brandBuilderConfig)
    {
        $baseElement = new static();

        $baseElement->setBrandBuilderConfig($brandBuilderConfig);

        $collection = new Collection();

        foreach ($this->elements as $element) {
            $baseElement->getElements($element)
                ->each(function ($cssStyle) use ($collection, $element) {

                    //Todo: Switch to an actual class
                    if (is_subclass_of($element, TextBase::class) || $element == BorderRadius::class) {
                        $str = str_replace('_', '-', $cssStyle->getSelector());
                        $str = str_replace('.', '', $str);

                        $cssStyle->setSelector($str);
                    }
                    $collection->add($cssStyle);
                });
        }

        $collection->add($baseElement->addAbstractedElement('header', Link::class, 'nav_link'));
        $collection->add($baseElement->addAbstractedElement('footer', Link::class, 'footer_link'));

        $otherElements = [
            HrDivider::class,
            VerticalDivider::class,
            HasTextGradient::class,
//            HasBackgroundGradient::class,
        ];

        foreach ($otherElements as $otherElement) {
            $collection->add($otherElement::makeCssStyle($brandBuilderConfig->getPrefix()));
        }

        return $collection;
    }

    public function addAbstractedElement($elementName, $element, $colorVariable) : CssStyle
    {
        $cssStyle = new CssStyle($elementName);
        $cssStyle->setIsElement(true);
        $wrapperCssStyle = new WrapperCssStyle();

        $this->getElements($element, $colorVariable)
            ->each(function ($cssStyle) use ($wrapperCssStyle) {
                $wrapperCssStyle->addSubClass($cssStyle);
            });


        $cssStyle->addSubClass($wrapperCssStyle);

        return $cssStyle;
    }

    public function getElements($cssElement, $colorVariable = null): Collection
    {
        $collection = new Collection();

        $cssItem = new $cssElement();

        foreach ($cssItem->items() as $item) {
            $key = $item['key'];

            if ($cssItem->hasFixedColorAttribute()) {
                $colorVariable = $this->brandBuilderConfig->getPrefix() . $key;
            }

            if (!$colorVariable) {
                $colorVariable = $this->brandBuilderConfig->getPrefix() . $key;
            }

            $builder = $cssItem->getMasterBuilder($key, $key, $colorVariable);
            $builder->setPreferredVariables([]);

            $cssStyle = $this->brandBuilderConfig->getDirector()->make($builder);

            $collection->add($cssStyle);
        }

        return $collection;
    }

    /**
     * @param BrandBuilderConfig $brandBuilderConfig
     * @return BaseElements
     */
    public function setBrandBuilderConfig(BrandBuilderConfig $brandBuilderConfig): BaseElements
    {
        $this->brandBuilderConfig = $brandBuilderConfig;

        return $this;
    }
}
