<?php

namespace App\Domain\Brand\CssStylesCollection;

use App\Domain\Brand\CssStyleBuilder\AbstractCssStyle;
use App\Domain\Brand\CssStyleBuilder\CssStyle;
use App\Domain\Brand\CssStylesCollection\Base\CssStylesCollection;
use App\Domain\Brand\CssStylesCollection\Base\NonResponsiveCssStylesCollection;
use App\Domain\ColorThemes\Colors;
use App\Domain\ColorThemes\Elements\Backgrounds\Background;
use App\Domain\ColorThemes\Mock\ColorSchemeMock;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class NonResponsiveHelperClasses extends CssStylesCollection
{
	public function getCssStyles(): Collection
	{
		$cssStyles[] = new CssStyle('has-text-underlined',
			[
				[
					'key' => 'text-decoration',
					'value' => 'underline !important',
				],
			]);

		$cssStyles[] = new CssStyle('is-radiusless',
			[
				[
					'key' => 'border-radius',
					'value' => 0,
				],
			]);

		$cssStyles[] = new CssStyle('is-shadowless',
			[
				[
					'key' => 'background-shadow',
					'value' => 'none',
				],
			]);

		$cssStyles[] = new CssStyle('is-clickable',
			[
				[
					'key' => 'cursor',
					'value' => 'pointer !important',
				],
			]);

		$cssStyles[] = new CssStyle('is-unselectable',
			[
				[
					'key' => 'user-select',
					'value' => 'none',
				],
				[
					'key' => '-moz-user-select',
					'value' => 'none',
				],
				[
					'key' => '-webkit-user-select',
					'value' => 'none',
				],
				[
					'key' => '-khtml-user-select',
					'value' => 'none',
				],
				[
					'key' => '-o-user-select',
					'value' => 'none',
				],
			]);

		$cssStyles[] = new CssStyle('is-rounded',
			[
				[
					'key' => 'border-radius',
					'value' => '100%',
				],
			]);

		$cssStyles[] = new CssStyle('is-overlay',
			[
				[
					'key' => 'background',
					'value' => 'rgba(0, 0, 0, 0.1)',
//					'value' => Colors::make('overlay')
				],
				[
					'key' => 'position',
					'value' => 'absolute',
				],
				[
					'key' => 'top',
					'value' => '0',
				],
				[
					'key' => 'left',
					'value' => '0',
				],
				[
					'key' => 'right',
					'value' => '0',
				],
				[
					'key' => 'bottom',
					'value' => '0',
				],
//                [
//                    'key' => 'z-index',
//                    'value' => '1',
//                ],
			]);
		
		$cssStyles[] = Background::make('has-background-transparent', 'transparent !important');
		
		$iconSizes = [
			'xxs' => '0.5em',
			'xs' => '0.75em',
			'sm' => '0.875em',
			'md' => '1em',
			'lg' => '1.3333em',
			'xl' => '1.5em',
			'2x' => '2em',
			'3x' => '3em',
		];
		
		$iconCssStyle = new CssStyle('i');
		$iconCssStyle->setIsElement(true);
		
		
		foreach ($iconSizes as $key => $size) {
			$iconSizeCssStyle = new CssStyle('is-' . $key);
			$iconSizeCssStyle->addStyle('font-size', $size);
			
			$iconCssStyle->addSubClass($iconSizeCssStyle);
		}
		
		$cssStyles[] = $iconCssStyle;
		
		
		return Collection::make($cssStyles);
	}
}
