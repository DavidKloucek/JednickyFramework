<?php
declare(strict_types=1);

namespace Jednicky\Utils;

use Closure;
use RuntimeException;

class ArrayCollection extends \Doctrine\Common\Collections\ArrayCollection
{
    public static function from(array $data): self
    {
        return new self($data);
    }

    public function mapToKeyValue(Closure $function): self
    {
        $items = [];
        foreach ($this->toArray() as $key => $value) {
            $res = $function($key, $value);
            if (!is_array($res) || count($res) !== 2 || !array_key_exists(0, $res) || !array_key_exists(1, $res)) {
                throw new RuntimeException();
            }
            $items[$res[0]] = $res[1];
        }
        return new self($items);
    }

    public function getColumn($key): array
    {
        return array_column($this->toArray(), $key);
    }

    public function getAssoc(string $path): array
    {
        return Arrays::associate($this->toArray(), $path);
    }

    public function map(Closure $func): self
    {
        return $this->createFrom(Arrays::map($this->toArray(), $func));
    }
}
