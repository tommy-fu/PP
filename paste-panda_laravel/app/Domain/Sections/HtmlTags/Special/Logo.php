<?php

namespace App\Domain\Sections\HtmlTags\Special;

use App\Domain\Sections\HtmlTags\HtmlModelBase;

class Logo extends HtmlModelBase
{
    public function __construct($node, $config)
    {
        $node['element'] = 'img';

        $logo = app('logos')->getLogo();

        $node['attributes']['src'] = $logo->image->getFullUrl();

        parent::__construct($node, $config);
    }

    public function getHtml()
    {
        try {
            $file = file_get_contents($this->getNode()['attributes']['src']);

            return str_replace('<svg ', '<svg class="logo-fill" ', $file);
        } catch (\Exception $ex) {
            return '<div></div>';
        }
    }
}
