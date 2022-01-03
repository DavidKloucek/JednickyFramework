<?php
declare(strict_types=1);

namespace Jednicky\Utils\Tests;

use Jednicky\Utils\Ean;
use Jednicky\Utils\EanException;
use Tester\Assert;

require __DIR__ . '/../bootstrap.php';

$eanZero = new Ean('072512199220');
$ean2 = new Ean('72512199220');

Assert::true($eanZero->isEquals($ean2));

Assert::equal($eanZero->getValueWithoutLeadingZero($eanZero->getValueWithoutLeadingZero()), '72512199220');

Assert::exception(function () {
    new Ean('');
}, EanException::class, "EAN '' není validní");

