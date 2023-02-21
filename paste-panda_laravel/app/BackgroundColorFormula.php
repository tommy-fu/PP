<?php

namespace App;

use App\Color\BaseColor;
use App\Color\PaletteGenerator;
use App\ColorContrast\Color;
use Illuminate\Database\Eloquent\Model;

/**
 * App\BackgroundColorFormula
 *
 * @property int $id
 * @property string $name
 * @property string|null $hex
 * @property int|null $hue
 * @property int|null $saturation
 * @property int|null $brightness
 * @property int $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $color_combination_id
 * @method static \Illuminate\Database\Eloquent\Builder|BackgroundColorFormula newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BackgroundColorFormula newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BackgroundColorFormula query()
 * @method static \Illuminate\Database\Eloquent\Builder|BackgroundColorFormula whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BackgroundColorFormula whereBrightness($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BackgroundColorFormula whereColorCombinationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BackgroundColorFormula whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BackgroundColorFormula whereHex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BackgroundColorFormula whereHue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BackgroundColorFormula whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BackgroundColorFormula whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BackgroundColorFormula whereSaturation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BackgroundColorFormula whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class BackgroundColorFormula extends Model
{
    public function generateBackgroundColor($hex)
    {
        $color = new Color($hex);

        if ($this->hex) {
            return $this->hex;
        }

        $color->HSVtoRGB($color->getHue(), $this->saturation, $this->brightness);

        return strtoupper($color->toHex());
    }

    public function generateBackgroundColors($hex): array
    {
        $colors = [];

        if ($this->hex) {
            return [$this->hex];
        }

        $color = new Color($hex);
        $color->HSVtoRGB($color->getHue(), $this->saturation, $this->brightness);

        $colors[] = strtoupper($color->toHex());

        if ($this->color_combination_id) {
            $baseColor = BaseColor::fromHex($hex);

            $paletteGenerator = new PaletteGenerator($baseColor);

            $generatedColors = [];

            if ($this->color_combination_id == 2) {
                $generatedColors = $paletteGenerator->monochromatic();
            }

            if ($this->color_combination_id == 3) {
                $generatedColors = $paletteGenerator->adjacent();
            }

            if ($this->color_combination_id == 4) {
                $generatedColors = $paletteGenerator->triad();
            }

            if ($this->color_combination_id == 5) {
                $generatedColors = $paletteGenerator->tetrad();
            }

            foreach (collect($generatedColors)->shift() as $key => $generatedColor) {
                $res = new Color($generatedColor->getHex());

                $res->HSVtoRGB($color->getHue(), $this->saturation, $this->brightness);

                $colors[] = strtoupper($res->toHex());
            }
        }

        return $colors;
    }
}
