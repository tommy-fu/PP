<?php

namespace App\Domain\Brand\CssStyleBuilder\States;

use App\Domain\Brand\CssStyleBuilder\AbstractCssStyle;
use App\Domain\Brand\CssStyleBuilder\CssStyle;
use App\Domain\ColorThemes\Colors;

abstract class StatefulBase implements Stateful
{
    private CssStyle $cssStyle;

    private array $overrides;

    public function __construct($overrides = [])
    {
        $this->overrides = $overrides;
    }

    public function baseStyles(): array
    {
        return [];
    }

    public function cssStyle($colorVariable = null, $attributes = []): AbstractCssStyle
    {
        $this->cssStyle = new CssStyle(':' . $this->pseudo());
        $this->cssStyle->setIsElement(true);

        foreach ($this->baseStyles() as $key=>$value) {
            $this->cssStyle->addStyle($key, $value);
        }

        if ($colorVariable) {
            foreach ($attributes as $attribute) {
                $this->cssStyle->addStyle($attribute, Colors::make($colorVariable . '_' . $this->pseudo() . '-' . $attribute));
            }
        }

        foreach ($this->overrides as $key=>$value) {
            $this->cssStyle->addStyle($key, $value);
        }

        return $this->cssStyle;
    }

    public function generate($colorVariable = null, $attributes = []): AbstractCssStyle
    {
        return $this->cssStyle($colorVariable, $attributes);
    }

    public static function make($attributes = []) : self
    {
        return new static($attributes);
    }
}
