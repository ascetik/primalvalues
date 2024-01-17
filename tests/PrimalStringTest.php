<?php

declare(strict_types=1);

namespace Ascetik\Primalvalues\Tests;

use Ascetik\Primalvalues\Values\PrimalString;
use PHPUnit\Framework\TestCase;

class PrimalStringTest extends TestCase
{
    public function testPrimalStringContent()
    {
        $string = PrimalString::of('hello');
        $this->assertSame('hello', $string->value());
    }

    public function testStringComparisons()
    {
        $string = PrimalString::of('hello');
        $this->assertTrue($string->equals('hello'));
        $this->assertFalse($string->equals('bye'));
    }

    public function testStringConcatenation()
    {
        $string = PrimalString::of('h');
        $concat = $string
            ->concat('e')
            ->concat('l')
            ->concat('l')
            ->concat('o');
        $this->assertSame('hello', $concat->value());
    }

    public function testSimpleConcatWithAnotherPrimalString()
    {
        $hello = PrimalString::of('hello');
        $world = PrimalString::of(' world');
        $concat = $hello->concat($world);
        $this->assertSame('hello world', $concat->value());
    }

    public function testGetCharacterAtGivenPosition()
    {
        $hello = PrimalString::of('hello');
        $this->assertSame('e',$hello->charAt(1));
        $this->assertNull($hello->charAt(8));
    }

    public function testCheckIfValueContainsString()
    {
        $hello = PrimalString::of('hello');
        $this->assertTrue($hello->contains('llo'));
        $this->assertFalse($hello->contains('hi'));
    }

    public function testCheckIfValueContainsPrimalString()
    {
        $hello = PrimalString::of('hello');
        $expected = PrimalString::of('llo');
        $unexpected = PrimalString::of('hi');
        $this->assertTrue($hello->contains($expected));
        $this->assertFalse($hello->contains($unexpected));
    }

    public function testCheckForEqualityWithString()
    {
        $hello = PrimalString::of('hello');
        $this->assertTrue($hello->equals('hello'));
    }

    public function testCheckForEqualityWithPrimalString()
    {
        $hello = PrimalString::of('hello');
        $this->assertTrue($hello->equals($hello));
    }


}
