<?php
declare(strict_types=1);

namespace Jednicky\Utils;

class Strings extends \Nette\Utils\Strings
{
    public static function zerofill(int $num, int $len): string
    {
        return sprintf('%0' . $len . 's', $num);
    }

    /**
     * @param string|null $price
     * @param mixed $default
     * @deprecated Please use priceFromInput()
     */
    public static function getInputPriceFormat(?string $price, $default = null): float
    {
        return self::priceFromInput($price, $default);
    }

    public static function priceFromInput($price, $default = null): float
    {
        if ($price === null) {
            return $default;
        }
        return floatval(str_replace(',', '.', str_replace(' ', '', $price)));
    }

    /**
     * @deprecated Please use priceToInput()
     * @param mixed $price
     * @return string
     */
    public static function getOutputPriceFormat($price): string
    {
        return self::priceToInput((float)$price);
    }

    public static function priceToInput(float $price): string
    {
        $price = trim(strval($price));
        return str_replace('.', ',', $price);
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
}
