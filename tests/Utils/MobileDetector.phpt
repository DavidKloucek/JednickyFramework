<?php
declare(strict_types=1);

namespace Jednicky\Utils\Tests;

use Jednicky\Utils\MobileDetector;
use Nette\Http\Request;
use Nette\Http\UrlScript;
use Tester\Assert;

require __DIR__ . '/../bootstrap.php';

$req = new Request(new UrlScript('https://localhost'), null, null, null, [
    'user-agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36'
]);

$detector = new MobileDetector($req);

Assert::false($detector->isMobile());


