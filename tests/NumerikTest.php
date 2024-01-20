<?php

declare(strict_types=1);

namespace Ascetik\Primalvalues\Tests;

use Ascetik\Primalvalues\Values\Numerik;
use PHPUnit\Framework\TestCase;

class NumerikTest extends TestCase
{

    public function testIntegerAdd()
    {
        $number = Numerik::of(8);
        $this->assertSame(10, $number->add(2)->value());
    }

    public function testSubstractNumberFromCurrentValue()
    {
        $number = Numerik::of(8);
        $this->assertSame(6, $number->subtract(2)->value());
    }

    public function testSubstractCurrentValueFromNumber()
    {
        $this->assertSame(10, Numerik::of(15)->subtractTo(25)->value());
    }

    public function testMultiplyIntegers()
    {
        $number = Numerik::of(8);
        $this->assertSame(16, $number->multiply(2)->value());
    }

    public function testNumericAsDividend()
    {
        $number = Numerik::of(8);
        $this->assertSame(4, $number->dividedBy(2)->value());
        $this->assertTrue($number->dividedBy(0)->isZero());
    }

    public function testNumericAsDiviser()
    {
        $this->assertSame(3, Numerik::of(2)->divides(6)->value());
        $this->assertSame(121, Numerik::of(3)->divides(363)->value());
        $this->assertTrue(Numerik::of(0)->divides(3845)->isZero());
    }

    public function testValueRaisedToNumber()
    {
        $number = Numerik::of(2);
        $this->assertEquals(4, $number->square()->value());
        $this->assertEquals(8, $number->cube()->value());
        $this->assertEquals(16, $number->power(4)->value());
    }

    public function testNumberRaisedToValue()
    {
        $this->assertEquals(8, Numerik::of(3)->exposing(2)->value());
        $this->assertEquals(25, Numerik::of(2)->exposing(5)->value());
    }

    public function testIntegerIncrement()
    {
        $number = Numerik::of(8);
        $this->assertSame(9, $number->increment()->value());
        $this->assertSame(13, $number->increment(5)->value());
    }

    public function testIntegerDecrement()
    {
        $number = Numerik::of(8);
        $this->assertSame(7, $number->decrement()->value());
        $this->assertSame(3, $number->decrement(5)->value());
    }
}
