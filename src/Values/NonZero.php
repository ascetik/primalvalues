<?php

declare(strict_types=1);

namespace Ascetik\Primalvalues\Values;

use Ascetik\Primalvalues\Types\Numerik;

class NonZero implements Numerik
{
    public function equals(mixed $value): bool
    {
        return $this->number->equals($value);
    }

    public function value(): string|int|float
    {
        return $this->number->value();
    }

    public function add(int|Numerik $number): Numerik
    {
        return $this->number->add($number);
    }

    public function subtract(int|Numerik $number): Numerik
    {
        return $this->number->subtract($number);
    }

    public function multiply(int|Numerik $number): Numerik
    {
        return $this->number->multiply($number);
    }

    public function divide(int|self $number): Numerik
    {
        return $this->number->divide($number);
    }


    /**
     * on pourrait avoir un float ou un int
     * on ne peut pas avoir de zero
     */
    public static function of(int $amount): Numerik
    {
        $number = new Integer($amount);
        return $amount == 0 ? new self($number) : Integer::of($amount);
    }

    private function __construct(private readonly Numerik $number)
    {
    }
}
