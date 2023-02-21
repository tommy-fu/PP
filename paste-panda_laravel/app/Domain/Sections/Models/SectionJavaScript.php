<?php

namespace App\Domain\Sections\Models;

use App\Domain\ColorThemes\Colors;
use App\Domain\Sections\HtmlTags\HtmlBaseTag;
use App\Domain\Sections\HtmlTags\HtmlTags;
use App\JavaScriptModule;
use App\Services\BladeCompiler;
use Illuminate\Support\Collection;

class SectionJavaScript
{
    /**
     * @var mixed
     */
    private $javaScriptModules;
    /**
     * @var mixed
     */
    private $javascript;
    /**
     * @var Collection
     */
    private Collection $dependencies;
    /**
     * @var mixed
     */
    private $fragments;
    private Section $section;
    /**
     * @var HtmlTags|\Illuminate\Contracts\Foundation\Application|mixed
     */
    private $htmlTags;

    /**
     * SectionJavaScript constructor.
     * @param Section $section
     */
    public function __construct(Section $section)
    {
        $this->javaScriptModules = $section->javaScriptModules;
        $this->javascript = $section->javascript;
        $this->dependencies = new Collection();
        $this->fragments = $section->fragments;
        $this->section = $section;
        $this->htmlTags = app(HtmlTags::class);
    }

    public function code(): string
    {
        $result = '(function()  {
		
	    "use strict";' . PHP_EOL;

        $result .= $this->javascript . PHP_EOL . PHP_EOL;

        $result .= $this->javaScriptModules->reduce(function ($carry, $module) {
            return $carry . $this->addJavaScriptModule($module);
        });

        foreach ($this->fragments as $fragment) {
            $result .= $fragment->js();
        }

        $this->htmlTags->getHtmlNodesFromSource($this->section->html)
            ->each(function (HtmlBaseTag $tag) use (&$result) {
                $result .= $tag->javaScript();
            });


        $result .= '}());';

        return html_entity_decode($result, ENT_QUOTES, 'UTF-8');
    }

    public function wrappedCode(): string
    {
        Colors::initialize();

        $result = $this->code();
        $result = $this->wrapInWindowLoad($result);

        return html_entity_decode($result, ENT_QUOTES, 'UTF-8');
    }


    private function wrapInWindowLoad($string): string
    {
        $result = "window.addEventListener('load',function(){" . PHP_EOL;

        $result .= $string;

        $result .= '});' . PHP_EOL;

        return $result;
    }

    public function dependencies()
    {
        return $this->javaScriptModules->flatMap(function ($module) {
            return $module->library_dependencies;
        });
    }

    /**
     * @param $module
     * @return string
     * @throws \Exception
     */
    private function addJavaScriptModule(JavaScriptModule $module): string
    {
        $this->dependencies = $this->dependencies->merge($module->library_dependencies);

        $config = json_decode($module->parameters, true);

        $args = json_decode($module->pivot->arguments, true);

        $arguments = $args['arguments'] ?? [];

        $arguments = array_merge_recursive_distinct($config, $arguments);

        $arguments = $this->convertToJsonString($arguments);

        return BladeCompiler::compileString($module->code, $arguments) . PHP_EOL;
    }

    /**
     * @param array $arguments
     * @return array
     */
    private function convertToJsonString(array $arguments): array
    {
        foreach ($arguments as $key => $value) {
            @json_decode($value);
            if (json_last_error() == JSON_ERROR_NONE) {
                $arguments[$key] = json_encode($value, JSON_UNESCAPED_UNICODE);
            }
        }

        return $arguments;
    }
}
