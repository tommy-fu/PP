<?php

namespace App\Domain\Sections\HtmlTags\Accordion;

use App\Domain\Sections\HtmlTags\HtmlBaseTag;
use DOMElement;

class AccordionHeader extends HtmlBaseTag
{
    public function createNode($domDocument): DOMElement
    {
        $newNode = $domDocument->createElement('div');
        $newNode->setAttribute('class', $this->getNode()->getAttribute('class') . ' accordion-header');
        
        $this->appendChildNodesFromRoot($newNode);

        return $newNode;
    }
}
