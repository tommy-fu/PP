<?php


namespace App\Services;

use DOMDocument;

class DomElementService
{
    public function getSource(\DOMElement $DOMElement)
    {
        $domDocument = new DOMDocument;
        $node = $domDocument->importNode($DOMElement, true);
        $domDocument->appendChild($node);
        
	    return $domDocument->saveHTML();
    }
}
