<?php

namespace App\Domain\Brand\CssStyleBuilder;

use App\ColorContrast\ColorItemV2;
use App\Domain\Brand\Models\Brand;
use App\Domain\ColorSchemeBuilder\ContrastChecker;
use App\Domain\ColorThemes\Colors;

class CssStyleBuilder implements ICssStyleBuilder
{
    private $className;

    private $styleItem;

    private $attributes = [];

    private $ignoredAttributes = [];

    private $modifiers = [];

    private $baseStyles = [];

    private $cssStyleStates = [];

    private $usesDashes = true;

    private $usesColorVariable = true;

    private $hasFixedColorAttribute = false;

    private array $preferredVariables = [];

    private $colorVariable;

    /**
     * @var CssStyle
     */
    private CssStyle $cssStyle;

    private array $subClasses = [];

    public function setClassName($className): self
    {
        $this->className = $className;

        return $this;
    }

    public function setColorVariable($colorVariable): self
    {
        $this->colorVariable = $colorVariable;

        return $this;
    }

    public function setIgnoredAttributes($ignoredAttributes): self
    {
        $this->ignoredAttributes = $ignoredAttributes;

        return $this;
    }

    public function removeAttributes()
    {
        foreach ($this->ignoredAttributes as $item) {
            unset($this->styleItem['base_styles'][$item], $this->styleItem['mobile_styles'][$item], $this->styleItem['tablet_styles'][$item], $this->styleItem['desktop_styles'][$item]);
        }
    }

    public function getCssStyle(): CssStyle
    {
        return $this->cssStyle;
    }

    public function addColors()
    {
        $item = $this->colorVariable;

        if (!$item) {
            return;
        }
        
        $cssStyle = $this->cssStyle;
        
        $this->addAttributesToCssStyle($item, $cssStyle);

        $this->addModifierClasses($cssStyle, $this->colorVariable);

        collect($this->cssStyleStates)
            ->each(function ($stateCssStyle) use ($cssStyle) {
                $style = $stateCssStyle->generate($this->colorVariable, $this->attributes);

                collect($this->modifiers)
                    ->each(function ($modifier) use ($stateCssStyle, $style) {
                        $cssStyle = $stateCssStyle->generate();
                        $this->addModifierClasses($cssStyle, $this->colorVariable . '_' . $stateCssStyle->getName());
                        $style->addSubClass($modifier::handle($this->colorVariable . '_' . $stateCssStyle->getName()));
                    });

                $this->cssStyle->addAdditionalStyle($style);
            });
    }

    private function getCssKey($attribute)
    {
        $lookup = [
            'text' => 'color',
        ];

        if ($this->hasFixedColorAttribute) {
            return 'color';
        }

        if (isset($lookup[$attribute])) {
            return $lookup[$attribute];
        }

        return $attribute;
    }

    private function getCssAttribute($item, $attribute)
    {
        if ($this->hasFixedColorAttribute) {
            return Colors::make($attribute);
        }

        //Todo: Bottleneck here
        if (!$this->usesColorVariable) {
            return Colors::make($attribute);
        }

        if (!$this->usesDashes) {
            return Colors::make($item);
        }
        
        if($attribute == 'box-shadow'){
        	$boxShadowString = app('brand')->variables[$item]['base_styles']['box-shadow'] . ' ' . Colors::make($item . '-' . $attribute);
        	
        	if(isset(app('brand')->variables[$item]['base_styles']['box-shadow-2'])){
		        $boxShadowString .= ', ' . app('brand')->variables[$item]['base_styles']['box-shadow-2'] . ' ' . Colors::make($item . '-' . $attribute . '-2');
	        }
        	
        	return $boxShadowString;
        }

        if (isset($this->preferredVariables[$attribute])) {

            //Don't use preferred color if it isn't hex
            if (ColorItemV2::isHex(Colors::make($item . '-' . $attribute))) {
                return ContrastChecker::getBestContrast(Colors::make('background'), Colors::make($this->preferredVariables[$attribute]), Colors::make($item . '-' . $attribute));
            }
        }

        return Colors::make($item . '-' . $attribute);
    }

    public function setStyleItem(array $styleItem): self
    {
        $this->styleItem = $styleItem;

        return $this;
    }

    public function setBaseStyles(array $baseStyles): self
    {
        $this->baseStyles = $baseStyles;

        return $this;
    }

    public function setUsesColorVariable($usesColorVariable): self
    {
        $this->usesColorVariable = $usesColorVariable;

        return $this;
    }

    public function setUsesDashes($usesDashes): self
    {
        $this->usesDashes = $usesDashes;

        return $this;
    }

    public function setAttributes($attributes): self
    {
        $this->attributes = $attributes;

        return $this;
    }

    public function reset()
    {
        $this->cssStyle = new CssStyle($this->className);
    }

    public function setBaseVariables()
    {
        $this->cssStyle->addStylesFromKeyValue($this->baseStyles);
    }

    public function setBrandVariables()
    {
        if ($this->styleItem == null) {
            return;
        }

        $this->cssStyle->setResponsiveValues($this->styleItem);
    }

    public function setHasFixedColorAttribute(bool $hasFixedColorAttribute): self
    {
        $this->hasFixedColorAttribute = $hasFixedColorAttribute;

        return $this;
    }

    /**
     * @param string $item
     * @param $cssStyle
     */
    private function addAttributesToCssStyle(string $item, $cssStyle): void
    {
        //Todo: Placeholder should probably not be here
        if ($this->hasFixedColorAttribute) {
            $value = $this->getCssAttribute($item, $item);

            $cssStyle->addStyle($this->getCssKey($item), $value);
        } else {
            collect($this->attributes)
                ->filter(function ($attribute) {
                    return $attribute != 'placeholder';
                })
	            ->filter(function ($attribute) {
		            return $attribute != 'box-shadow-2';
	            })
                ->each(function ($attribute) use ($item, $cssStyle) {
                    $value = $this->getCssAttribute($item, $attribute);

                    if ($value) {
                        $cssStyle->addStyle($this->getCssKey($attribute), $value);
                    }
                });
        }
    }

    public function addSubElements()
    {
        collect($this->subClasses)
            ->each(function ($subClass) {
                $this->cssStyle->addSubClass($subClass);
            });
    }

    public function setSubClasses(AbstractCssStyle $subClass)
    {
        $this->subClasses[] = $subClass;
    }

    /**
     * @param array $modifiers
     */
    public function setModifiers(array $modifiers): void
    {
        $this->modifiers = $modifiers;
    }

    /**
     * @param array $states
     */
    public function setCssStyleStates(array $states): void
    {
        $this->cssStyleStates = $states;
    }

    /**
     * @param AbstractCssStyle $cssStyle
     */
    protected function addModifierClasses(AbstractCssStyle $cssStyle, $colorVariable): void
    {
        collect($this->modifiers)
            ->each(function ($modifier) use ($cssStyle, $colorVariable) {
                $cssStyle->addSubClass($modifier::handle($colorVariable));
            });
    }

    /**
     * @param array $preferredVariables
     */
    public function setPreferredVariables(array $preferredVariables): void
    {
        $this->preferredVariables = $preferredVariables;
    }
}
