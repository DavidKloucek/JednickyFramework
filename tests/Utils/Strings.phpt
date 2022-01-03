<?php
declare(strict_types=1);

namespace Jednicky\Utils\Tests;

use Jednicky\Utils\Strings;
use Tester\Assert;

require __DIR__ . '/../bootstrap.php';

Assert::equal(Strings::zerofill(123, 5), '00123');
Assert::equal(Strings::zerofill(123, 2), '123');
