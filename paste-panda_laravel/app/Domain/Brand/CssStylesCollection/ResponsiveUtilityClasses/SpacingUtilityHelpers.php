<?php


namespace App\Domain\Brand\CssStylesCollection\ResponsiveUtilityClasses;


use App\Domain\Brand\CssStyleBuilder\CssStyle;

class SpacingUtilityHelpers implements IUtilityClass
{

	/**
	 * @return int[]
	 */
	public static function getSpacingValues(): array
	{
		$spacings = [0, 4, 8, 12];

		$base = 16;

		while ($base <= 208) {
			$spacings[] = $base;

			$base += 8;
		}
		
		return $spacings;
	}

	public function getUtilityClasses()
	{
		$spacingStyles = [];

		$spacings = self::getSpacingValues();

		$values = ['margin', 'padding'];

		$positions = ['top', 'bottom', 'left', 'right'];

		foreach ($values as $val) {

			foreach ($positions as $position) {

				$classPrefix = substr($val,0,1) . substr($position,0,1) ;

				foreach ($spacings as $key => $spacing) {

					$spacingStyles[] = new CssStyle($classPrefix . '-' . $spacing, [
						[
							'key' => $val .'-' . $position,
							'value' => $spacing . 'px !important'
						]
					]);
				}
			}
		}


		foreach ($spacings as $key => $spacing) {

			$spacingStyles[] = new CssStyle('my-' . $spacing, [
				[
					'key' => 'margin-top',
					'value' => $spacing . 'px'
				],
				[
					'key' => 'margin-bottom',
					'value' => $spacing . 'px !important'
				]
			]);
		}

		foreach ($spacings as $key => $spacing) {

			$spacingStyles[] = new CssStyle('mx-' . $spacing, [
				[
					'key' => 'margin-left',
					'value' => $spacing . 'px !important'
				],
				[
					'key' => 'margin-right',
					'value' => $spacing . 'px !important'
				]
			]);
		}


		foreach ($spacings as $key => $spacing) {

			$spacingStyles[] = new CssStyle('py-' . $spacing, [
				[
					'key' => 'padding-top',
					'value' => $spacing . 'px !important'
				],
				[
					'key' => 'padding-bottom',
					'value' => $spacing . 'px !important'
				]
			]);
		}


		foreach ($spacings as $key => $spacing) {

			$spacingStyles[] = new CssStyle('px-' . $spacing, [
				[
					'key' => 'padding-left',
					'value' => $spacing . 'px !important'
				],
				[
					'key' => 'padding-right',
					'value' => $spacing . 'px !important'
				]
			]);
		}

		return $spacingStyles;
	}
}
