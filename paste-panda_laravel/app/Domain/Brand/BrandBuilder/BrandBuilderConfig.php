<?php


namespace App\Domain\Brand\BrandBuilder;

use App\Domain\Brand\CssStyleBuilder\ICssStyleDirector;
use App\Domain\ColorSchemeBuilder\ColorSchemePrefix;
use App\Domain\ColorThemes\ColorScheme;

class BrandBuilderConfig
{
    private ?ColorScheme $scheme;

    private ?ColorSchemePrefix $prefix = null;

    private ?ICssStyleDirector $director;

    private ?String $className;

    public function __construct()
    {
    	$this->prefix = new ColorSchemePrefix();
    }
	
	/**
     * @return ColorScheme
     */
    public function getScheme(): ColorScheme
    {
        return $this->scheme;
    }

    /**
     * @param ColorScheme $scheme
     */
    public function setScheme(ColorScheme $scheme): self
    {
        $this->scheme = $scheme;

        return $this;
    }

    /**
     * @return String
     */
    public function getPrefix(): ?string
    {
        return $this->prefix->getPrefix();
    }

    /**
     * @param String $prefix
     * @return BrandBuilderConfig
     */
    public function setPrefix(?string $prefix): BrandBuilderConfig
    {
        $this->prefix = new ColorSchemePrefix($prefix);

        return $this;
    }

    /**
     * @return ICssStyleDirector
     */
    public function getDirector(): ICssStyleDirector
    {
        return $this->director;
    }

    /**
     * @param ICssStyleDirector $director
     * @return BrandBuilderConfig
     */
    public function setDirector(ICssStyleDirector $director): BrandBuilderConfig
    {
        $this->director = $director;

        return $this;
    }

    /**
     * @return String
     */
    public function getClassName(): ?string
    {
        return $this->className;
    }

    /**
     * @param String $className
     * @return BrandBuilderConfig
     */
    public function setClassName(?string $className): BrandBuilderConfig
    {
        $this->className = $className;

        return $this;
    }
}
