<?php

namespace App\Domain\ColorSchemeBuilder;

class BaseSchemeBuilder extends AbstractSchemeBuilder
{
    public static string $prefix = '';

    public function setBaseColors(): self
    {
        $this->setFixedValue('overlay_solid', 'linear-gradient(111.65deg, #000000 0%, rgba(0, 0, 0, 0) 99.49%)');
        $this->setSchemeColor('background', $this->getBackground());

        return $this;
    }
}
