<?php


namespace App\Domain\Sections\HtmlTags\Special;

use App\Domain\Sections\HtmlTags\HtmlModelBase;
use App\Domain\Sections\Models\HtmlConfig;
use Illuminate\Support\Collection;

class Hamburger extends HtmlModelBase
{
    public function __construct($node, HtmlConfig $config)
    {
        parent::__construct($node, $config);
    }

    public function getAttributes(): Collection
    {
        return collect(['class', 'style', 'src', 'onclick', 'id']);
    }

    public function getHtml()
    {
        return '<div id="hamburger" class="burger burger-arrow burger-right">
                  <div class="burger-lines"></div>
                </div>';
    }

    public function hasChildren()
    {
        return false;
    }


    public function hasClosingBracket()
    {
        return false;
    }
}
