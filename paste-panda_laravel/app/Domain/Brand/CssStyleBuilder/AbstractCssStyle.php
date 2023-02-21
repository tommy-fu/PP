<?php

namespace App\Domain\Brand\CssStyleBuilder;

use App\Services\CssServices;
use Illuminate\Support\Collection;

abstract class AbstractCssStyle
{
	private $selector;
	
	private $styles;
	
	private $additionalStyles = [];
	
	private $viewports;
	
	private Collection $subClasses;
	
	private $isElement = false;
	
	public function __construct($selector, $styles = [])
	{
		$this->selector = $selector;
		$this->styles = $styles;
		
		$this->subClasses = new Collection();
		$this->viewports = new Collection();
	}
	
	public function addToViewports(self $cssStyle): self
	{
		$this->viewports->add($cssStyle);
		
		return $this;
	}
	
	public function getViewPorts(): Collection
	{
		return $this->viewports;
	}
	
	public function addStyle($key, $value): self
	{
		$this->removeStyle($key);
		
		$this->styles[] = [
			'key' => $key,
			'value' => $value,
		];
		
		return $this;
	}
	
	public function removeStyle($key)
	{
		$this->styles = collect($this->styles)
			->filter(function ($style) use ($key) {
				return $style['key'] != $key;
			})->toArray();
	}
	
	/**
	 * @return mixed
	 */
	public function getSelector()
	{
		$prefix = $this->isElement ? '' : '.';
		
		return $prefix . $this->selector;
	}
	
	public function getStyleString()
	{
		$css = '';
		
		try {
			foreach ($this->styles as $style) {
				if (isset($style['value'])) {
					if ($style['value'] != '') {
						$css .= '  ' . CssServices::getCssStyle($style['key'], $style['value']);
					}
				}
			}
		}
		catch (\Exception $e) {
			dd($this->styles);
		}
		
		return $css;
	}
	
	public function addStylesFromKeyValue($styles)
	{
		foreach ($styles as $key => $value) {
//        	if($value){
			$this->addStyle($key, $value);
			//	        }
		}
		
		return $this;
	}
	
	public function getStyleByKey($key)
	{
		return collect($this->styles)
			->filter(function ($style) use ($key) {
				return $style['key'] == $key;
			})->first()['value'];
	}
	
	public function getStyleValueByKey($key)
	{
		try {
			return collect($this->styles)
				->filter(function ($style) use ($key) {
					return $style['key'] == $key;
				})->first()['value'];
		}
		catch (\Exception $e) {
			return null;
		}
		
	}
	
	public function addAdditionalStyle(self $cssStyle)
	{
		$this->additionalStyles[] = $cssStyle;
		
		return $this;
	}
	
	public function addAdditionalStyles(array $cssStyles)
	{
		$this->additionalStyles = array_merge($this->additionalStyles, $cssStyles);
		
		return $this;
	}
	
	/**
	 * @return array
	 */
	public function getAdditionalStyles(): array
	{
		return $this->additionalStyles;
	}
	
	/**
	 * @param mixed $selector
	 */
	public function setSelector($selector): void
	{
		$this->selector = $selector;
	}
	
	public function find($key)
	{
		return collect($this->styles)
			->first(function ($style) use ($key) {
				return $style['key'] == $key;
			});
	}
	
	public function addSubClass(self $subClass): self
	{
		$subClass->parent = $this;
		
		$this->subClasses->add($subClass);
		
		return $this;
	}
	
	/**
	 * @return array|mixed
	 */
	public function getStyles(): array
	{
		return $this->styles;
	}
	
	/**
	 * @return Collection
	 */
	public function getSubClasses(): Collection
	{
		return $this->subClasses;
	}
	
	public function renderClass($newSelector): string
	{
		$baseCss = '';
		
		if (count($this->getStyles()) > 0) {
			$baseCss = $newSelector . ' {' . PHP_EOL;
			$baseCss .= $this->getStyleString();
			$baseCss .= '}' . PHP_EOL . PHP_EOL;
		}
		
		return $baseCss;
	}
	
	public static function make($selector): self
	{
		return new static($selector);
	}
	
	/**
	 * @return bool
	 */
	public function isElement(): bool
	{
		return $this->isElement;
	}
	
	/**
	 * @param bool $isElement
	 */
	public function setIsElement(bool $isElement): self
	{
		$this->isElement = $isElement;
		
		return $this;
	}
}
