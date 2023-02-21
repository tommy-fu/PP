<?php

namespace App\Domain\Sections\HtmlTags\Accordion;

use App\Domain\Sections\HtmlTags\HtmlBaseTag;
use DOMElement;
use Illuminate\Support\Facades\View;

class Accordion extends HtmlBaseTag
{
    public function createNode($domDocument): DOMElement
    {
        $newNode = $domDocument->createElement('div');
        $newNode->setAttribute('class', $this->getNode()->getAttribute('class') . ' accordion');

        if ($this->getNode()->hasAttribute('active')) {
            $newNode->setAttribute('class', $this->getNode()->getAttribute('class') . ' accordion is-active');
        }

        $this->appendChildNodesFromRoot($newNode);

        return $newNode;
    }
	
	public function css(): string
	{
		return View::file(resource_path('custom_components/accordion/accordion_css.blade.php'))->render();
	}

    public function javaScript(): string
    {
	    return View::file(resource_path('custom_components/accordion/accordion_js.blade.php'))->render();
    }
}
