<?php

namespace Tests\Feature\Users;

use App\Domain\Brand\Models\Brand;
use App\Domain\ColorThemes\Mock\ColorSchemeMock;
use App\Domain\Users\User;
use App\Services\HtmlServices;
use App\Services\HtmlToJsonConverter;
use Tests\DbTestCase;

class UserHtmlTest extends DbTestCase
{
	
	
	
	/** @test */
	public function it_can_select_html()
	{
		$this->markTestSkipped();
		$this->withoutExceptionHandling();
		$user = Factory(User::class)->create();

		$user->programming_language_id = 0;
		
		$this->be($user);
		
		$this->put(route('user-programming-languages.update', 1))
			->assertSessionHasNoErrors()
			->assertStatus(302);
		
		app()->singleton('programming_languages', function () use($user){
			return $user->fresh()->programming_language_id;
		});
		
		$html = '<div class="test"><p>Foobar</p></div>';
		
		$converter = new HtmlToJsonConverter();
		
		$json = $converter->convertHtml($html);
		
		$htmlService = new HtmlServices();
		
		$renderedHtml = $htmlService->getHtml(json_decode($json, true));
		
		$this->assertStringNotContainsString('class="', $renderedHtml);
		$this->assertStringContainsString('className="', $renderedHtml);
		
		$this->put(route('user-programming-languages.update', 0))
			->assertSessionHasNoErrors()
			->assertStatus(302);
		
		app()->singleton('programming_languages', function () use($user){
			return $user->fresh()->programming_language_id;
		});
		
		$htmlService = new HtmlServices();
		
		$renderedHtml = $htmlService->getHtml(json_decode($json, true));
		
		$this->assertStringNotContainsString('className="', $renderedHtml);
		$this->assertStringContainsString('class="', $renderedHtml);
	}
	
}
