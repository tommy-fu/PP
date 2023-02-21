<?php

namespace App\Domain\ColorSchemeBuilder;

class OverlaySchemeBuilder extends AbstractSchemeBuilder
{
    public static string $prefix = 'overlay';

    public function setBaseColors(): self
    {
    	return $this;
    }
}
