<?php

namespace App\Domain\ColorSchemeBuilder;

use App\ColorContrast\Color;
use App\SchemeColorFormula;

abstract class AbstractSchemeBuilder
{
    protected $hex;

    protected $background;

    protected $scheme = [];

    private SchemeColorsCollection $schemeElementsCollection;

    public static function make($hex, $background): self
    {
        $item = new static();
        $item->hex = $hex;
        $item->background = $background;

        return $item;
    }

    /**
     * @return mixed
     */
    public function getBackground()
    {
        return $this->background;
    }

    public function hasDarkBackground()
    {
        $color = new Color($this->background);

        return $color->isDark();
    }

    public function generate(): array
    {
        $this->setSchemeFormulaDependingOnBackground()
            ->setBaseColors()
            ->setColorValues();

        return $this->scheme;
    }

    public function setFixedValue($key, $hex)
    {
        $this->scheme[$key] = $hex;
    }

    public function setSchemeColor($key, $hex)
    {
        $this->scheme[$key] = strtoupper('#' . $hex);
    }

    public function setSchemeFormulaDependingOnBackground(): self
    {
        if ($this->hasDarkBackground()) {
            $schemeFormula = SchemeColorFormula::where('theme_type', 1)
                ->where('type', $this->getColorFormulaType())
                ->first();
        } else {
            $schemeFormula = SchemeColorFormula::where('theme_type', 0)
                ->where('type', $this->getColorFormulaType())
                ->first();
        }

        $prefix = new ColorSchemePrefix(static::$prefix);

        $this->schemeElementsCollection = new SchemeColorsCollection($schemeFormula, $this->hex, $prefix);

        return $this;
    }

    protected function setColorValues(): self
    {
        $this->schemeElementsCollection->getVariables()
            ->each(function ($value, $key) {
                $this->scheme[$key] = $value;
            });

        return $this;
    }

    public function getColorFormulaType() : int
    {
        return SchemeColorFormula::STANDARD_TYPE;
    }

    abstract public function setBaseColors(): self;
}
