<?php

declare(strict_types=1);

namespace Ascetik\Primalvalues\Tests;

use Ascetik\Primalvalues\Values\PrimalString;
use PHPUnit\Framework\TestCase;

class PrimalStringTest extends TestCase
{
    public function testPrimalStringContent()
    {
        $string = new PrimalString('hello');
        $this->assertSame('hello', $string->value());
    }
}
