<?php

namespace App\Domain\Brand\BrandBuilder\Scheme;

use App\Domain\Brand\BrandBuilder\BrandBuilderConfig;
use App\Domain\ColorThemes\Elements\HrDivider;
use App\Domain\ColorThemes\Elements\LogoFill;
use App\Domain\ColorThemes\Elements\SocialMediaIcon;
use Illuminate\Support\Collection;

class AddCustomElementsAndModifiersToScheme
{
	private $cssStyleElements = [
		HrDivider::class,
		LogoFill::class,
//        CursorSelection::class,
	];
	
	
	public function handle(BrandBuilderConfig $brandBuilderConfig)
	{
		$collection = new Collection();
		$prefix = $brandBuilderConfig->getPrefix();
		
		foreach ($this->cssStyleElements as $cssStyleElement) {
			$collection->add($cssStyleElement::makeCssStyle($prefix));
		}
		
		foreach (SocialMediaIcon::makeCssStyles($prefix)->toArray() as $item) {
			$collection->add($item);
		}
		
		
		return $collection;
	}
}
