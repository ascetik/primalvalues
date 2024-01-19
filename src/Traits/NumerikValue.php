<?php

declare(strict_types=1);

namespace Ascetik\Primalvalues\Traits;

use Ascetik\Hypothetik\Core\When;
use Ascetik\Hypothetik\Core\Maybe;
use Ascetik\Primalvalues\Values\Numerik;

/**
 * @property int|float $value
 */
trait NumerikValue
{
    public function add(int|Numerik $number): self
    {
        $sum = $this->value + $this->ensureValue($number)->value();
        return new self($sum);
    }

    public function subtract(int|Numerik $number): self
    {
        $difference = $this->value - $this->ensureValue($number)->value();
        return new self($difference);
    }

    public function multiply(int|Numerik $number): self
    {
        $product = $this->value * $this->ensureValue($number)->value();
        return new self($product);
    }

    public function divide(int|Numerik $number): self
    {
        $number = $this->ensureValue($number)->value();
        $when = When::ever($number === 0)
            ->then(fn (int $zero) => $zero)
            ->otherwise($this->value / $number);
        return new self($when->value());
    }

    public function value(): float
    {
        return $this->value;
    }

    /**
     * @param int|static $int
     *
     * @return Maybe<int>
     */
    protected function ensureValue(int|float|Numerik $number): Maybe
    {
        return When::ever($number instanceof Numerik)
            ->then(fn (Numerik $primal) => $primal->value(), $number)
            ->otherwise($number);
    }
}
