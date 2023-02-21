<?php


namespace App\Domain\Sections\Models;


class HtmlConfig
{
	private int $depth;
	private bool $isFragment = false;
	private array $classes = [];
	private $fragmentId;
	private $rootClass = Section::class;
	
	/**
	 * HtmlConfig constructor.
	 */
	public function __construct()
	{
		$this->depth = 0;
	}
	
	public function getDepth()
	{
		return $this->depth;
	}
	
	public function setDepth($depth){
		$this->depth = $depth;
	}
	
	public function setUIClasses(array $classes){
		$this->isFragment = true;
		$this->classes = $classes;
	}
	
	/**
	 * @return bool
	 */
	public function isFragment(): bool
	{
		return $this->isFragment;
	}
	
	/**
	 * @return array
	 */
	public function getClasses(): array
	{
		return $this->classes;
	}
	
	/**
	 * @param bool $isFragment
	 */
	public function setIsFragment(bool $isFragment): void
	{
		$this->isFragment = $isFragment;
	}
	
	/**
	 * @return mixed
	 */
	public function getFragmentId()
	{
		return $this->fragmentId;
	}
	
	/**
	 * @param mixed $fragmentId
	 * @return HtmlConfig
	 */
	public function setFragmentId($fragmentId)
	{
		$this->fragmentId = $fragmentId;
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function getRootClass(): string
	{
		return $this->rootClass;
	}
	
	/**
	 * @param string $rootClass
	 */
	public function setRootClass(string $rootClass): void
	{
		$this->rootClass = $rootClass;
	}
}
