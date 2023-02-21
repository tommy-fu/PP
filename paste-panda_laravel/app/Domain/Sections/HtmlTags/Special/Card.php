<?php


namespace App\Domain\Sections\HtmlTags\Special;


use App\Domain\Sections\HtmlTags\HtmlModelBase;
use Illuminate\Support\Collection;

class Card extends HtmlModelBase
{
	
	public function getAttributes(): Collection
	{
		return collect(['class', 'style', 'src']);
	}
	
	public function getHtml()
	{
		
		return '
		        <div class="is-relative" style="height: 360px; border-radius: 12px; width: 100%; overflow: hidden; background: url(\'http://paste-panda-laravel.dew/images/avatars/profile.jpeg\')">
          <div style="background: rgba(0, 0, 0, 0.3); position: absolute; top: 0; bottom: 0; left: 0; right: 0; z-index: 24;"></div>

          <div class="px-24 pb-16" style="position: absolute; bottom: 0; left: 0; z-index: 500;">
            <h5 class="heading-5" style="position: relative; z-index: 5; color: #FFF; margin-bottom: 0;">Velma Jennings</h5>
          </div>
        </div>
      </div>';
	}
	
	public function hasChildren()
	{
		return false;
	}
	
	
	public function hasClosingBracket()
	{
		return false;
	}
}
