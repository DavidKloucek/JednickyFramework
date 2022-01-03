<?php
declare(strict_types=1);

namespace Jednicky\Utils;

use Nette\Utils\Strings;
use Nette\Utils\Validators;

class Email
{
    /** @var string */
    protected $email;

    public function __construct(string $email)
    {
        $email = trim($email);
        if (!Validators::isEmail($email)) {
            throw new InvalidEmailException();
        }
        $this->email = $email;
    }

    public function getPartiallyErasedName(string $char = '*'): string
    {
        $split = explode('@', $this->email);
        $name = $split[0];
        if (Strings::length($name) > 2) {
            $name = Strings::substring($name, 0, 2).str_repeat($char, Strings::length($name)-2);
        } else {
            $name = str_repeat('*', Strings::length($split[0]));
        }
        return $name.'@'.$split[1];
    }

    public function get(): string
    {
        return $this->email;
    }

    public function __toString(): string
    {
        return $this->get();
    }
}
