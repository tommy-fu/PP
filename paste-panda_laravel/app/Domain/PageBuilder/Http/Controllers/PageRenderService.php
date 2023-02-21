<?php


namespace App\Domain\PageBuilder\Http\Controllers;

use App\Domain\Sections\HtmlTags\Navbar;
use App\Services\HtmlNodeService;
use Illuminate\Support\Collection;

class PageRenderService
{
    private Collection $sections;

    private $navbar = null;
    private $cssDependencies;
    private $jsDependencies;
    private HtmlNodeService $htmlNodeService;
    private string $css = '';

    /**
     * PageRenderService constructor.
     */
    public function __construct(Collection $sections)
    {
        $this->sections = $sections;

        $this->htmlNodeService = new HtmlNodeService();

        $this->setDependencies();
    }

    public function getHtml(): string
    {
        return $this->sections->filter($this->filterNavbar())
            ->reduce(function ($total, $section) use (&$html) {
                if (!$this->navbar) {
	                $this->css .= $section->css_codes->code();
                    return $total . $section->htmlCode->getRenderedHtml();
                }

                if ($this->hasTag($section, 'background-image')) {
                    $section->html = $this->addToHtmlNode('background-image', $section->html);
                    
                    return $total . $section->htmlCode->getRenderedHtml();
                }

                
                return $total . $this->getFilledNavbarHtml();
            }, '');
    }

    public function hasTag($section, $tag): bool
    {
        return str_contains($section->html, $tag);
    }

    public function addToHtmlNode($tag, $source)
    {
        $element = $this->htmlNodeService->getNodeByTag($source, $tag);

        if ($element) {
            $navbarNode = $this->htmlNodeService->createNodeFromSource($this->navbar->html);
	
	        $navbar = Navbar::create($navbarNode->ownerDocument, $navbarNode);
	
	        $this->navbar->html = $navbar->ownerDocument->saveHTML();
	
	        $this->css .= $this->navbar->css_codes->code();
	
	        $this->navbar = null;
	        
            $element->ownerDocument->importNode($navbarNode);

            $element->removeAttribute('filled');
            $navbar = Navbar::create($navbarNode->ownerDocument, $navbarNode);
            
//            $navbar->setAttribute('filled', 'false');
	        
            $element->setAttribute('style', $element->getAttribute('style') . ' padding-top: 128px;');

            return $this->htmlNodeService->addNodeToDomElement($element, $navbar);
        }

        return $source;
    }

    /**
     * @param $section
     * @return bool
     */
    protected function isNavbar($section): bool
    {
        return str_contains($section->html, 'navbar') === true;
    }

    protected function setDependencies()
    {
        $dependencies = $this->sections->flatMap(function ($section) {
            return $section->dependencies;
        })
            ->unique('id');

        $cssDependencies = $dependencies->filter(function ($dependency) {
            return $dependency->type == 1;
        })->pluck('url');

        $jsDependencies = $dependencies->filter(function ($dependency) {
            return $dependency->type == 2;
        })->pluck('url');

        $this->cssDependencies = $cssDependencies->map(function ($dependency) {
            return '<link rel="stylesheet" href="' . $dependency . '"/>';
        });

        $this->jsDependencies = $jsDependencies->map(function ($dependency) {
            return '<script type="text/javascript" src="' . $dependency . '"></script>';
        });
    }

    /**
     * @return mixed
     */
    public function getCssDependencies()
    {
        return $this->cssDependencies;
    }

    /**
     * @return mixed
     */
    public function getJsDependencies()
    {
        return $this->jsDependencies;
    }

    /**
     * @return \Closure
     */
    protected function filterNavbar(): \Closure
    {
        return function ($section) {
            if ($this->isNavbar($section)) {
                $this->navbar = $section;

                return false;
            }

            return true;
        };
    }

    /**
     * @param string $total
     * @return string
     */
    protected function getFilledNavbarHtml(): string
    {
        $node = $this->htmlNodeService->createNodeFromSource($this->navbar->html);
        
	    $node->setAttribute('filled', 'true');
	    
        $navbar = Navbar::create($node->ownerDocument, $node);
        
        $this->navbar->html = $navbar->ownerDocument->saveHTML();
        
        $result = $this->navbar->html_code->getRenderedHtml();
	
	    $this->css .= $this->navbar->css_codes->code();
	    
	    $this->navbar = null;
	
	    return $result;
    }
	
	/**
	 * @return string
	 */
	public function getCss(): string
	{
		return $this->css;
	}
}
