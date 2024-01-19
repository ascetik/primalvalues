<?php

declare(strict_types=1);

namespace Ascetik\Primalvalues\Values;

use Ascetik\Hypothetik\Core\When;
use Ascetik\Hypothetik\Core\Maybe;
use Ascetik\Primalvalues\Types\PrimalValue;

class Numerik implements PrimalValue
{
    public function add(int|Numerik $number): self
    {
        $sum = $this->value + $this->ensureValue($number)->value();
        return new self($sum);
    }

    public function cube(): self
    {
        return $this->power(3);
    }

    public function decrement(int|self $increase = 1): self
    {
        $value = $this->value - $this->ensureValue($increase)->value();
        return new self($value);
    }

    public function divide(int|Numerik $number): self
    {
        $quotient = $this->ensureValue($number)
            ->then(fn (int|float $num) => $num != 0)
            ->then(fn (int|float $num) => $this->value / $num, $number)
            ->otherwise(0)
            ->value();
        return self::of($quotient);
    }

    public function equals(mixed $value): bool
    {
        return $value === $this->value;
    }

    public function increment(int|self $increase = 1): self
    {
        $value = $this->value + $this->ensureValue($increase)->value();
        return new self($value);
    }

    public function multiply(int|Numerik $number): self
    {
        $product = $this->value * $this->ensureValue($number)->value();
        return new self($product);
    }

    public function power(int|float|self $number): self
    {
        return $this->ensureValue($number)
            ->then(fn (int|float $exponent) => pow($this->value, $exponent))
            ->then(self::of(...))
            ->value();
    }

    public function square(): self
    {
        return $this->power(2);
    }

    public function squareRoot(): self
    {
        return self::of(sqrt($this->value()));
    }

    public function subtract(int|Numerik $number): self
    {
        $difference = $this->value - $this->ensureValue($number)->value();
        return new self($difference);
    }

    public function value(): int|float
    {
        return $this->value;
    }

    public static function of(int|float $number): self
    {
        return new self($number);
    }

    private function __construct(private readonly int|float $value)
    {
    }

    /**
     * @param int|static $int
     *
     * @return Maybe<int>
     */
    private function ensureValue(int|float|Numerik $number): Maybe
    {
        return When::ever($number instanceof Numerik)
            ->then(fn (Numerik $primal) => $primal->value(), $number)
            ->otherwise($number);
    }
}
