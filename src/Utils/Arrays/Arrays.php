<?php
declare(strict_types=1);

namespace Jednicky\Utils;

use Closure;
use Nette\Utils\Strings;
use Symfony\Component\PropertyAccess\PropertyAccessor;

class Arrays extends \Nette\Utils\Arrays
{
    public static function filterList(array $arr, callable $callback): array
    {
        foreach ($arr as $key => &$value) {
            if (!$callback($value, $key)) {
                unset($arr[$key]);
            }
        }
        return array_values($arr);
    }

    public static function filter(array $arr, callable $callback): array
    {
        return array_filter($arr, $callback, ARRAY_FILTER_USE_BOTH);
    }

    public static function of(array $array, string $className): bool
    {
        foreach ($array as $item) {
            if (!($item instanceof $className)) {
                return false;
            }
        }
        return true;
    }

    public static function getFirstKey(array $array, $default = null)
    {
        return count($array) > 0 ? array_keys($array)[0] : $default;
    }

    public static function hasKeyCaseInsensitive(array $arr, string $key): bool
    {
        $keys = self::map(array_keys($arr), function ($val) {
            if (is_string($val)) {
                return Strings::lower($val);
            }
            return $val;
        });
        return in_array(Strings::lower($key), $keys, true);
    }

    public function removeValue(array &$arr, $val)
    {
        $i = array_search($val, $arr);
        if ($i !== false) {
            unset($arr[$i]);
        }
    }

    public static function mapList(array $arr, callable $func): array
    {
        return array_values(Arrays::map($arr, $func));
    }

    /**
     * @param array $arr
     * @param Closure|string|int $keyMapper
     * @return array
     * @throws ArraysException
     */
    public static function mapKeys(array $arr, $keyMapper): array
    {
        $return = [];
        foreach ($arr as $item) {
            if (is_callable($keyMapper)) {
                $return[$keyMapper($item)] = $item;
            } else if (is_string($keyMapper)) {
                $propAccessor = new PropertyAccessor();
                $return[$propAccessor->getValue($item, $keyMapper)] = $item;
            } else {
                throw new ArraysException();
            }
        }

        return $return;
    }

    public static function containsValue(array $array, $value): bool
    {
        return in_array($value, $array, true);
    }

    public static function getLastKey(array $array, $default = null)
    {
        if (!function_exists('array_key_last')) {
            if (count($array) > 0) {
                return array_keys($array)[0];
            }
            return $default;
        }
        return array_key_last($array);
    }
}
