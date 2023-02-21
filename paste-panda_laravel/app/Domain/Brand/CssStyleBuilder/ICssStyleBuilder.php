<?php

namespace App\Domain\Brand\CssStyleBuilder;

interface ICssStyleBuilder
{
    public function reset();

    public function setClassName($className);

    public function setStyleItem(array $styleItem);

    public function setCssStyleStates(array $states);

    public function setAttributes($attributes);

    public function getCssStyle() : CssStyle;

    public function setBaseVariables();
    
    public function setBrandVariables();
}
