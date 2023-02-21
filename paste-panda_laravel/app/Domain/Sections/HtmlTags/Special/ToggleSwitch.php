<?php


namespace App\Domain\Sections\HtmlTags\Special;

use App\Domain\Brand\CssStyleBuilder\CssStyle;
use App\Domain\Sections\HtmlTags\HtmlModelBase;
use Illuminate\Support\Collection;

class ToggleSwitch extends HtmlModelBase
{


	public function getHtml(){

		return '<label class="switch">
  <input class="switch-input" type="checkbox" checked>
  <span class="slider round"></span>
</label>';
	}

	function getCssStyles(): Collection
	{
		$collection = new Collection();

		$cssStyle = new CssStyle('switch', [
			[
				'key' => 'position',
				'value' => 'relative',
			],
			[
				'key' => 'display',
				'value' => 'inline-block',
			],
			[
				'key' => 'width',
				'value' => '60px',
			], [
				'key' => 'height',
				'value' => '34px',
			]
		]);

		$collection->add($cssStyle);


		$cssStyle = new CssStyle('switch .switch-input', [
			[
				'key' => 'opacity',
				'value' => '0',
			],
			[
				'key' => 'width',
				'value' => '0',
			],
			[
				'key' => 'height',
				'value' => '0',
			]
		]);

		$collection->add($cssStyle);

		$cssStyle = new CssStyle('slider', [
			[
				'key' => 'position',
				'value' => 'absolute',
			],
			[
				'key' => 'cursor',
				'value' => 'pointer',
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
			[
				'key' => 'background',
				'value' => '#ccc',
			],
			[
				'key' => '-webkit-transition',
				'value' => '.4s',
			],
			[
				'key' => 'transition',
				'value' => '.4s',
			]
		]);

		$collection->add($cssStyle);


		$cssStyle = new CssStyle('slider:before', [
			[
				'key' => 'position',
				'value' => 'absolute',
			],
			[
				'key' => 'content',
				'value' => '""',
			],
			[
				'key' => 'height',
				'value' => '26px',
			],
			[
				'key' => 'width',
				'value' => '26px',
			],
			[
				'key' => 'left',
				'value' => '4px',
			],
			[
				'key' => 'bottom',
				'value' => '4px',
			],
			[
				'key' => 'background',
				'value' => '#fff',
			],
			[
				'key' => '-webkit-transition',
				'value' => '.4s',
			],
			[
				'key' => 'transition',
				'value' => '.4s',
			]
		]);

		$collection->add($cssStyle);

		$cssStyle = new CssStyle('switch-input:checked + .slider', [
			[
				'key' => 'background',
				'value' => '#2196F3',
			],
		]);

		$collection->add($cssStyle);

		$cssStyle = new CssStyle('switch-input:focus + .slider', [
			[
				'key' => 'box-shadow',
				'value' => '0 0 1px #2196F3',
			],
		]);

		$collection->add($cssStyle);

		$cssStyle = new CssStyle('switch-input:checked + .slider:before', [
			[
				'key' => '-webkit-transform',
				'value' => 'translateX(26px)',
			],
			[
				'key' => '-ms-transform',
				'value' => 'translateX(26px)',
			],
			[
				'key' => 'transform',
				'value' => 'translateX(26px)',
			]
		]);

		$collection->add($cssStyle);

		$cssStyle = new CssStyle('slider.round', [
			[
				'key' => 'border-radius',
				'value' => '34px',
			],
		]);

		$collection->add($cssStyle);

		$cssStyle = new CssStyle('slider.round:before', [
			[
				'key' => 'border-radius',
				'value' => '50%',
			],
		]);

		$collection->add($cssStyle);

		return $collection;
	}

	function getJavaScript(): string
	{
		return '';
	}
}
