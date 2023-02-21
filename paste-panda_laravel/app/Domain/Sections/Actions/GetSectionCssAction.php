<?php

namespace App\Domain\Sections\Actions;

use App\Domain\Sections\HtmlTags\HtmlBaseTag;
use App\Domain\Sections\HtmlTags\HtmlTags;
use App\Domain\Sections\Models\Section;
use Illuminate\Support\Facades\Auth;

class GetSectionCssAction
{
    private $htmlTags;

    public function __construct()
    {
        $this->htmlTags = app(HtmlTags::class);
    }


    public function execute($id) : string
    {
        $section = Section::findOrFail($id);

        $customCss = $section->css ?? '';

        $this->htmlTags->getHtmlNodesFromSource($section->html)
            ->each(function (HtmlBaseTag $tag) use (&$customCss) {
                $customCss .= $tag->css();
            });

        return $customCss;
    }
}
