<?php


namespace App\Domain\Sections\HtmlTags;

use DOMDocument;
use DOMElement;
use DOMNode;

abstract class HtmlBaseTag
{
    private DOMElement $node;

    /**
     * BackgroundImage constructor.
     */
    public function __construct(DOMElement $newNode)
    {
        $this->node = $newNode;
    }


    public function styles(): array
    {
        return [];
    }

    public function classes(): array
    {
        return [];
    }

    public function excludedAttributes(): array
    {
        return [];
    }

    public static function create($domDocument, $childNode): \DOMElement
    {
        $item = new static($childNode);

        $newNode = $item->createNode($domDocument);

        $styleString = trim($newNode->getAttribute('style') . ' ' . implode('; ', $item->styles()));
        if (strlen($styleString) > 0) {
            $newNode->setAttribute('style', $styleString);
        }

        $classString = trim($newNode->getAttribute('class') . ' ' . implode(' ', $item->classes()));

        if (strlen($styleString) > 0) {
            $newNode->setAttribute('class', $classString);
        }

        return $newNode;
    }


    abstract public function createNode($domDocument): DOMElement;

    /**
     * @return DOMElement
     */
    public function getNode(): DOMElement
    {
        return $this->node;
    }

    public function appendHTML(DOMNode $parent, $source)
    {
        $tmpDoc = new DOMDocument();
        $tmpDoc->loadHTML(mb_convert_encoding($source, 'HTML-ENTITIES', 'UTF-8'));

        foreach ($tmpDoc->getElementsByTagName('body')->item(0)->childNodes as $node) {
            $node = $parent->ownerDocument->importNode($node, true);
            $parent->appendChild($node);
        }
    }

    /**
     * @param $newNode
     */
    public function appendChildNodesFromRoot($newNode): void
    {
        foreach ($this->getNode()->childNodes as $node) {
            $newNode->appendChild($node->cloneNode(true));
        }
    }
	
	public function bladeParameters() : array{
		return [];
    }

    public function css() : string
    {
        return '';
    }

    public function javaScript() : string
    {
        return '';
    }
}
