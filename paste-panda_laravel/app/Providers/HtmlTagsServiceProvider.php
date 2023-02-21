<?php

namespace App\Providers;

use App\Domain\Sections\HtmlTags\Accordion\Accordion;
use App\Domain\Sections\HtmlTags\Accordion\AccordionBody;
use App\Domain\Sections\HtmlTags\Accordion\AccordionHeader;
use App\Domain\Sections\HtmlTags\Avatar;
use App\Domain\Sections\HtmlTags\BackgroundImage;
use App\Domain\Sections\HtmlTags\HtmlTags;
use App\Domain\Sections\HtmlTags\IphoneX;
use App\Domain\Sections\HtmlTags\Navbar;
use App\Domain\Sections\HtmlTags\UnsplashImage;
use Illuminate\Support\ServiceProvider;

class HtmlTagsServiceProvider extends ServiceProvider
{
    protected array $htmlTags = [
        'background-image' => BackgroundImage::class,
        'unsplash-image' => UnsplashImage::class,
        'avatar' => Avatar::class,
        'iphone-x' => IphoneX::class,
        'accordion' => Accordion::class,
        'accordion-header' => AccordionHeader::class,
        'accordion-body' => AccordionBody::class,
        'navbar' => Navbar::class,
    ];

    public function register()
    {
        $this->app->singleton(HtmlTags::class, function () {
            return new HtmlTags($this->htmlTags);
        });
    }
}
