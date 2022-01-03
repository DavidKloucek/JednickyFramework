<?php
declare(strict_types=1);

namespace Jednicky\Utils;

class Strings extends \Nette\Utils\Strings
{
    public static function zerofill(int $num, int $len): string
    {
        return sprintf('%0' . $len . 's', $num);
    }

    public static function isValidInputPrice($value): bool
    {
        $value = str_replace(' ', '', $value);
        return (bool)preg_match('/^[0-9]{1,}([,\.][0-9]{1,}){0,1}$/', $value);
    }

    public static function stripSpaces(string $str): string
    {
        return self::trim(Strings::replace($str, '/\s+/u', ' '));
    }

    /**
     * @param string price
     * @param null $default
     * @return float
     */
    public static function getInputPriceFormat($price, $default = null): float
    {
        if ($price === null) {
            return 0;//$default;
        }
        return floatval(str_replace(',', '.', str_replace(' ', '', $price)));
    }

    /**
     * @param int|float|string|null $price
     * @return string
     */
    public static function getOutputPriceFormat($price): string
    {
        return str_replace('.', ',', (string)$price);
    }
}
