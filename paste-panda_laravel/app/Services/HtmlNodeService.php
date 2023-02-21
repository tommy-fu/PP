<?php


namespace App\Services;

use DOMDocument;

class HtmlNodeService
{
    private DomElementService $domElementService;

    public function __construct()
    {
        $this->domElementService = new DomElementService();
    }

    public function getNodeByTag($source, $tag): ?\DOMElement
    {
        libxml_use_internal_errors(true);

        $tmpDoc = new DOMDocument();
        $this->loadHtml($tmpDoc, $source);

        $elementsWithTagName = $tmpDoc->getElementsByTagName($tag);

        if (count($elementsWithTagName) == 0) {
            return null;
        }

        return $elementsWithTagName[0];
    }

    public function addNodeToDomElement(\DOMElement $element, \DOMElement $nodeToAdd): string
    {
        $doc2 = new DOMDocument();

        $this->loadHtml($doc2, $this->domElementService->getSource($nodeToAdd));

        $node = $element->ownerDocument->importNode($doc2->firstChild, true);
        
        $element->appendChild($node);

        return $element->ownerDocument->saveHTML();
    }

    public function createNodeFromSource(string $source) : \DOMElement
    {
	    libxml_use_internal_errors(true);
	    
        $tmpDoc = new \DOMDocument();
        $this->loadHtml($tmpDoc, $source);

        return collect($tmpDoc->childNodes)
	        ->first(function($node){
	        	return $node->nodeType === 1;
	        });
    }


    /**
     * @param DOMDocument $doc2
     * @param string $source
     * @return bool|DOMDocument
     */
    protected function loadHtml(DOMDocument $doc2, string $source)
    {
        return $doc2->loadHTML(mb_convert_encoding($source, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
    }
}
