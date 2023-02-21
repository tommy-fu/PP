<?php


namespace App\Domain\Sections\Models;

use App\Domain\Sections\HtmlModifier\HasTextHtmlModifier;
use App\Domain\Sections\HtmlTags\HtmlTags;
use DOMDocument;

class SectionHtml
{
    private $section;

    private $htmlTags;

    /**
     * SectionHtml constructor.
     * @param Section $section
     */
    public function __construct($section)
    {
        $this->section = $section;

        $this->htmlTags = app(HtmlTags::class);
    }


    public function getRenderedHtml()
    {
        return $this->getHtml();
    }


    public function getPreviewHtml()
    {
        $renderedHtml = $this->getHtml();

        collect([
            'has-min-height-25vh',
            'has-min-height-50vh',
            'has-min-height-75vh',
            'has-min-height-100vh',
            'has-height-25vh',
            'has-height-50vh',
            'has-height-75vh',
            'has-height-100vh-desktop',
            'has-100vh-desktop',
        ])->each(function ($vh) use (&$renderedHtml) {
            $renderedHtml = str_replace($vh, 'has-100vh', $renderedHtml);
        });

        return $renderedHtml;
    }


    public function getChildNode(\DOMDocument $domDocument, $childNodes)
    {
        foreach ($childNodes as $childNode) {
            (new HasTextHtmlModifier())->removeTextModifierWithBadContrast($childNode);

            if (isset($this->htmlTags->get()[$childNode->nodeName])) {
                $item = $this->htmlTags->get()[$childNode->nodeName];

                $newNode = $item::create($domDocument, $childNode);

                $childNode->parentNode->replaceChild($newNode, $childNode);

                $childNode = $newNode->parentNode;
            }

            $this->getChildNode($domDocument, $childNode->childNodes);
        }
    }

    /**
     * @return false|string
     */
    protected function getHtml()
    {
        $rootDom = new DOMDocument();

        //This line allows us to use our own tags
        libxml_use_internal_errors(true);

        $element = $this->createRootNode($rootDom);

        $this->addNodesToRootElement($rootDom, $element);

        $rootDom->appendChild($element);

        $this->getChildNode($rootDom, $rootDom->childNodes);

        return $rootDom->saveHTML();
    }

    /**
     * @param DOMDocument $rootDom
     * @return \DOMElement|false
     */
    protected function createRootNode(DOMDocument $rootDom)
    {
        $element = $rootDom->createElement('div');
        $element->setAttribute('id', 'section-' . $this->section->id);
        $element->setAttribute('class', 'scheme-' . \Auth::user()->color_scheme_id);

        return $element;
    }

    /**
     * @param DOMDocument $rootDom
     * @param $element
     */
    protected function addNodesToRootElement(DOMDocument $rootDom, $element): void
    {
        $tmpDoc = new DOMDocument();
        $tmpDoc->loadHTML(mb_convert_encoding($this->section->html, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

        foreach ($tmpDoc->childNodes as $node) {
            $node = $rootDom->importNode($node, true);
            $element->appendChild($node);
        }
    }
}
