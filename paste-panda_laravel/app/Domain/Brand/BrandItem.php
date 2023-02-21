<?php


namespace App\Domain\Brand;


class BrandItem
{
	private ViewportBrandItem $baseStyles;
	private ViewportBrandItem $mobileStyles;
	private ViewportBrandItem $tabletStyles;
	private ViewportBrandItem $desktopStyles;
	
	public function __construct(array $array)
	{
		$this->baseStyles = new ViewportBrandItem($array['base_styles']);
		$this->mobileStyles = new ViewportBrandItem($array['mobile_styles']);
		$this->tabletStyles = new ViewportBrandItem($array['tablet_styles']);
		$this->desktopStyles = new ViewportBrandItem($array['desktop_styles']);
	}
	
	public function getResponsiveStyle($viewport){
		
		$brandItems = [
			'mobile' => $this->mobileStyles,
			'tablet' => $this->tabletStyles,
			'desktop' => $this->desktopStyles
		];
		
		return $brandItems[$viewport];
	}
	
	public function baseStyles(){
		return $this->baseStyles;
	}
	
	public function mobileStyles(){
		return $this->mobileStyles;
	}
	
	public function tabletStyles(){
		return $this->tabletStyles;
	}
	
	public function desktopStyles(){
		return $this->desktopStyles;
	}
}
