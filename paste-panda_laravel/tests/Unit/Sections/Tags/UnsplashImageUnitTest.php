<?php

namespace Tests\Unit\Sections\Tags;

use App\Domain\ColorThemes\Colors;
use App\Domain\ColorThemes\ColorScheme;
use App\Domain\Sections\HtmlTags\UnsplashImage;
use App\Domain\Sections\Models\HtmlConfig;
use App\Domain\Sections\Models\Image;
use App\Domain\Users\User;
use App\Services\HtmlToJsonConverter;
use Tests\DbTestCase;

class UnsplashImageUnitTest extends DbTestCase
{
    /** @test */
    public function it_has_a_closing_bracket()
    {
	    $this->markTestSkipped();
        $colorScheme = Factory(ColorScheme::class)->create();

        Colors::setScheme($colorScheme);

        $img = Image::create([
            'img_url' => 'foobar',
        ]);

        $user = Factory(User::class)->create(
            ['color_scheme_id' => $colorScheme->id]
        );

        $this->be($user);

        $config = new HtmlConfig();

        $html = '<unsplash-image><div>Foobar</div></unsplash-image>';

        $node = (new HtmlToJsonConverter)->convertHtml($html);

        $htmlElement = new UnsplashImage(json_decode($node, true), $config);

        $html = $htmlElement->getHtml();
    }
}
