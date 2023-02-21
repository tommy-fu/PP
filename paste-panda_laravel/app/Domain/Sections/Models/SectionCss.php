<?php

namespace App\Domain\Sections\Models;

use App\Domain\Sections\HtmlTags\HtmlBaseTag;
use App\Domain\Sections\HtmlTags\HtmlTags;

class SectionCss
{
    private Section $section;
    /**
     * @var HtmlTags|\Illuminate\Contracts\Foundation\Application|mixed
     */
    private $htmlTags;
    
    public function __construct(Section $section)
    {
        $this->section = $section;
        $this->htmlTags = app(HtmlTags::class);
    }

    public function code(): string
    {
        $css = $this->section->css ?? '';

        $this->htmlTags->getHtmlNodesFromSource($this->section->html)
            ->each(function (HtmlBaseTag $htmlTag) use (&$css) {
                $css .= $htmlTag->css();
            });

        return $css;
    }

    public function dependencies()
    {
        return [];
    }
}
