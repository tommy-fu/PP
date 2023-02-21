<?php


namespace App\Domain\Sections\Models;


class SectionDependencies
{
	private Section $section;
	private $css_dependencies;
	private $js_dependencies;
	
	/**
	 * SectionDependencies constructor.
	 * @param Section $section
	 */
	public function __construct(Section $section)
	{
		$this->section = $section;
		
		$dependencies = $section->dependencies;
		
		$cssDependencies = $dependencies->filter(function ($dependency) {
			return $dependency->type == 1;
		})->pluck('url');
		
		$cssDependencies->prepend('https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css');
		
		$jsDependencies = $dependencies->filter(function ($dependency) {
			return $dependency->type == 2;
		})->pluck('url');
		
		$this->css_dependencies = $cssDependencies->map(function ($dependency) {
			return '<link rel="stylesheet" href="' . $dependency . '"/>';
		});
		
		$this->js_dependencies = $jsDependencies->map(function ($dependency) {
			return '<script type="text/javascript" src="' . $dependency . '"></script>';
		});
	}
	
	public function getCssDependencies(){
		return $this->css_dependencies;
	}
	
	public function getJavaScriptDependencies(){
		return $this->js_dependencies;
	}
}
