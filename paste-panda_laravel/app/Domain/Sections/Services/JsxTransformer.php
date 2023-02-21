<?php

namespace App\Domain\Sections\Services;

class JsxTransformer
{
    public static function convertClassString($classString)
    {
        return $classString ? 'className' . '="' . $classString . '"' : '';
    }

    public static function convertStyleString($style) : string
    {
        $res = [];

        $styles = explode(';', $style);

        foreach ($styles as $style) {
            if (strlen($style) > 0) {
                $strs = explode(':', $style, 2);
                $key = self::dashesToCamelCase($strs[0]);
                $res[$key] = trim($strs[1]);
            }
        }

        $str = '';

        $count = count($res);
        foreach ($res as $key => $value) {
            $str .= $key . ':' . '"' . $value . '"';

            if ($key != $count - 1) {
                $str .= ',';
            }
        }

        return strlen($str) > 0 ? ' style={{' . $str . '}}' : '';
    }
	
	public static function dashesToCamelCase($string, $capitalizeFirstCharacter = false)
	{
		$str = str_replace(' ', '', ucwords(str_replace('-', ' ', $string)));
		
		if (!$capitalizeFirstCharacter) {
			$str[0] = strtolower($str[0]);
		}
		
		return $str;
	}
}
