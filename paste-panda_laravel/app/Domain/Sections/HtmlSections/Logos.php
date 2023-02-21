<?php

namespace App\Domain\Sections\HtmlSections;

use App\Domain\Sections\Models\Logo;
use Illuminate\Support\Facades\Cache;

class Logos
{
    private $logos;
    private $originalLogos;

    public function __construct()
    {
        $this->logos = Cache::rememberForever('logos', function () {
            return Logo::with('image')
                ->get();
        });

        $this->originalLogos = $this->logos;
    }

    public function getLogos($gender = null)
    {
        return $this->logos;
    }

    public function getLogo()
    {
        if (count($this->logos) == 0) {
            $this->logos = $this->originalLogos;
        }

        $foundLogo = collect($this->logos)
//            ->shuffle()
            ->first();

        $this->logos = collect($this->logos)
            ->filter(function ($logo) use ($foundLogo) {
                return $logo['id'] != $foundLogo['id'];
            });

        return $foundLogo;
    }
}
