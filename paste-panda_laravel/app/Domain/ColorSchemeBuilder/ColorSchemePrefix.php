<?php


namespace App\Domain\ColorSchemeBuilder;


class ColorSchemePrefix
{
	protected string $prefix;
	
	public function __construct(string $prefix = null)
	{
		$this->prefix = $prefix ? $prefix . '_' : '';
	}
	
	/**
	 * @return string
	 */
	public function getPrefix(): string
	{
		return $this->prefix;
	}
}
