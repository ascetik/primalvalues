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

    public function testIntegerSubtract()
    {
        $number = Numerik::of(8);
        $this->assertSame(6, $number->subtract(2)->value());
    }

    public function testMultiplyIntegers()
    {
        $number = Numerik::of(8);
        $this->assertSame(16, $number->multiply(2)->value());
    }

    public function testDivideIntegers()
    {
        $number = Numerik::of(8);
        $this->assertSame(4, $number->divide(2)->value());
        $this->assertSame(0, $number->divide(0)->value());
    }

    public function testUseMathPowers()
    {
        $number = Numerik::of(2);
        $this->assertEquals(4, $number->square()->value());
        $this->assertEquals(8, $number->cube()->value());
        $this->assertEquals(16, $number->power(4)->value());
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
