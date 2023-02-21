<?php

namespace Tests\Unit\Sections\Tags;

use App\Domain\ColorThemes\Colors;
use App\Domain\ColorThemes\ColorScheme;
use App\Domain\Sections\HtmlTags\Special\BackgroundImage;
use App\Domain\Sections\Models\HtmlConfig;
use App\Domain\Sections\Models\Image;
use App\Domain\Users\User;
use App\Services\HtmlToJsonConverter;
use Tests\DbTestCase;

class BackgroundImageTagUnitTest extends DbTestCase
{
    /** @test */
    public function it_has_a_closing_bracket()
    {
	    $this->markTestSkipped();
        $colorScheme = Factory(ColorScheme::class)->create();

        Colors::setScheme($colorScheme);

        Image::create([
            'img_url' => 'foobar',
        ]);

        $user = Factory(User::class)->create(
            ['color_scheme_id' => $colorScheme->id]
        );

        $this->be($user);

        $config = new HtmlConfig();

        $html = '<background-image><div>Foobar</div></background-image>';

        $node = (new HtmlToJsonConverter)->convertHtml($html);

        $htmlElement = new BackgroundImage(json_decode($node, true), $config);

        $html = $htmlElement->getHtml();
        
//
//		$this->assertStringContainsString('<img', $html);
//		$this->assertStringContainsString('src="foobar"', $html);
//		$this->assertStringContainsString('/>', $html);
    }
}
