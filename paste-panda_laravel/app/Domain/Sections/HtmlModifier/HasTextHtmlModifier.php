<?php


namespace App\Domain\Sections\HtmlModifier;

use App\Domain\ColorSchemeBuilder\ContrastChecker;
use App\Domain\ColorThemes\Colors;
use App\Domain\ColorThemes\Elements\Modifiers\DerivedColor;

class HasTextHtmlModifier
{
    /**
     * @param $childNode
     */
    public function removeTextModifierWithBadContrast($childNode): void
    {
        $modifiers = [
            'primary',
            'secondary',
            'tertiary',
            'quaternary',
        ];

        foreach ($modifiers as $modifier) {
            $this->updateNodeClassDependingOnLuminosity($childNode, $modifier);
        }
    }

    private function updateNodeClassDependingOnLuminosity($childNode, $modifier)
    {
        if (!$this->shouldSetClassAttribute($childNode, $modifier)) {
            return;
        }

        if (ContrastChecker::hasGoodLuminosity(Colors::make('background'), Colors::make($modifier))) {
            return;
        }

        if (ContrastChecker::hasGoodLuminosity(Colors::make('background'), DerivedColor::make(Colors::make($modifier))->toFullHex())) {
            $childNode->setAttribute('class', $childNode->getAttribute('class') . ' is-derived');

            return;
        }

        $childNode->setAttribute('class', str_replace('has-text-' . $modifier, 'has-text-base', $childNode->getAttribute('class')));
    }

    private function shouldSetClassAttribute($childNode, $modifier): bool
    {
        if (method_exists($childNode, 'setAttribute')) {
            if (str_contains($childNode->getAttribute('class'), 'has-text-' . $modifier)) {
                return true;
            }
        }

        return false;
    }
}
