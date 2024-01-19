<?php

declare(strict_types=1);

namespace Ascetik\Primalvalues\Tests;

use Ascetik\Primalvalues\Values\Integer;
use PHPUnit\Framework\TestCase;

class IntegerTest extends TestCase
{

    public function testIntegerAdd()
    {
        $number = Integer::of(8);
        $this->assertSame(10, $number->add(2)->value());
    }

    public function testIntegerSubtract()
    {
        $number = Integer::of(8);
        $this->assertSame(6, $number->subtract(2)->value());
    }

    public function testMultiplyIntegers()
    {
        $number = Integer::of(8);
        $this->assertSame(16, $number->multiply(2)->value());
    }

    public function testDivideIntegers()
    {
        $number = Integer::of(8);
        $this->assertSame(4, $number->divide(2)->value());
        // $this->assertSame(0, $number->divide(0)->value());
    }


    public function testIntegerIncrement()
    {
        $number = Integer::of(8);
        $this->assertSame(9, $number->increment()->value());
        $this->assertSame(13, $number->increment(5)->value());
    }

    public function testIntegerDecrement()
    {
        $number = Integer::of(8);
        $this->assertSame(7, $number->decrement()->value());
        $this->assertSame(3, $number->decrement(5)->value());
    }
}
