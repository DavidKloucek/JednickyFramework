<?php
declare(strict_types=1);

namespace Jednicky\Utils\Tests;

use Jednicky\Utils\Arrays;
use Tester\Assert;

require __DIR__ . '/../bootstrap.php';

Assert::equal(Arrays::getLastKey([
    'a' => 1,
    'b' => 2,
    'c' => 3
]), 'c');

Assert::equal(Arrays::getFirstKey([
    'a' => 1,
    'b' => 2,
    'c' => 3
]), 'a');

Assert::true(Arrays::hasKeyCaseInsensitive(['key' => 1], 'kEY'));
Assert::true(Arrays::hasKeyCaseInsensitive(['key' => 1], 'key'));
Assert::false(Arrays::hasKeyCaseInsensitive(['key' => 1], 'keyx'));
Assert::false(Arrays::hasKeyCaseInsensitive(['key' => 1], ''));
