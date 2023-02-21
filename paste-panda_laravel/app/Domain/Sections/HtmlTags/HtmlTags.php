<?php


namespace App\Domain\Sections\HtmlTags;

use DOMDocument;
use Illuminate\Support\Collection;

class HtmlTags
{
    private $collections;

    public function __construct($collections)
    {
        $this->collections = $collections;
    }

    public function get()
    {
        return $this->collections;
    }

    public function getHtmlNodesFromSource($source) : Collection
    {
        $collection = new Collection();

        $tmpDoc = new DOMDocument();

        libxml_use_internal_errors(true);

        $tmpDoc->loadHTML(mb_convert_encoding($source, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

        foreach ($this->get() as $key => $value) {
            if ($this->hasSpecialElement($key, $tmpDoc)) {
                $newNode = new $value($tmpDoc->getElementsByTagName($key)[0]);

                $collection->add($newNode);
            }
        }

        return $collection;
    }

    public function hasSpecialElement($className, $tmpDoc) : bool
    {
        return count($tmpDoc->getElementsByTagName($className)) > 0;
    }
}
