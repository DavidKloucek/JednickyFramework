<?php
declare(strict_types=1);

namespace Jednicky\Utils;

use Nette\Utils\Strings;

class Ean
{
    /** @var string */
    protected $value;

    /**
     * @throws EanException
     */
    public function __construct(string $value)
    {
        $value = Strings::trim($value);

        // @todo Tady by se měla opatrně doplnit validace, ale už nyní máme v databázích klientů nevalidní EANy, tak bacha
        // Je začínající 0 validní nebo ne?
        // Nutné také zavést validaci self::isEan13()
        //$value = self::removeLeadingZero($value);

        if ($value === '') {
            throw new EanException("EAN '$value' není validní");
        }

        $this->value = $value;
    }

    public function isEquals(Ean $ean): bool
    {
        return self::removeLeadingZero($ean->getValue()) === self::removeLeadingZero($this->value);
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function getValueWithoutLeadingZero(): string
    {
        return self::removeLeadingZero($this->value);
    }

    public static function isEan13(string $code): bool
    {
        // check to see if barcode is 13 digits long
        if (!preg_match('/^[0-9]{13}$/', $code)) {
            return false;
        }
        $digits = $code;

        // 1. Add the values of the digits in the
        // even-numbered positions: 2, 4, 6, etc.
        $even_sum = $digits[1] + $digits[3] + $digits[5] + $digits[7] + $digits[9] + $digits[11];

        // 2. Multiply this result by 3.
        $even_sum_three = $even_sum * 3;

        // 3. Add the values of the digits in the
        // odd-numbered positions: 1, 3, 5, etc.
        $odd_sum = $digits[0] + $digits[2] + $digits[4] + $digits[6] + $digits[8] + $digits[10];

        // 4. Sum the results of steps 2 and 3.
        $total_sum = $even_sum_three + $odd_sum;

        // 5. The check character is the smallest number which,
        // when added to the result in step 4, produces a multiple of 10.
        $next_ten = (ceil($total_sum / 10)) * 10;
        $check_digit = $next_ten - $total_sum;

        // if the check digit and the last digit of the
        // barcode are OK return true;
        if ($check_digit == $digits[12]) {
            return true;
        }

        return false;
    }

    protected static function removeLeadingZero(string $text): string
    {
        return preg_replace('#^(0+)#', '', $text);
    }
}
