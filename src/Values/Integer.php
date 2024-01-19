<?php

declare(strict_types=1);

namespace Ascetik\Primalvalues\Values;

use Ascetik\Hypothetik\Core\When;
use Ascetik\Hypothetik\Core\Maybe;
use Ascetik\Primalvalues\Types\Numerik;
use Ascetik\Primalvalues\Values\NonZero;

class Integer implements Numerik
{
    public function add(int|Numerik $number): self
    {
        $sum = $this->value + $this->ensureInteger($number)->value();
        return new self($sum);
    }

    public function decrement(int|self $increase = 1): self
    {
        $value = $this->value - $this->ensureInteger($increase)->value();
        return new self($value);
    }

    public function equals(mixed $value): bool
    {
        return is_integer($value) ? $value == $this->value : false;
    }

    public function increment(int|self $increase = 1): self
    {
        $value = $this->value + $this->ensureInteger($increase)->value();
        return new self($value);
    }

    public function subtract(int|Numerik $number): self
    {
        $difference = $this->value - $this->ensureInteger($number)->value();
        return new self($difference);
    }

    public function multiply(int|Numerik $number): self
    {
        $product = $this->value * $this->ensureInteger($number)->value();
        return new self($product);
    }

    public function divide(int|NonZero $number): self
    {
        $number = $this->ensureInteger($number)->value();
        $quotient = $number === 0
            ? 0
            : $this->value / $number;
        return new self($quotient);
    }

    public function value(): int
    {
        return $this->value;
    }

    public static function of(int $number): self
    {
        return new self($number);
    }

    private function __construct(private readonly int $value)
    {
    }

    /**
     * @param int|self $int
     *
     * @return Maybe<int>
     */
    private function ensureInteger(int|float|self $number): Maybe
    {
        return When::ever($number instanceof Numerik)
            ->then(fn (Numerik $primal) => $primal->value(), $number)
            ->otherwise($number);
    }
}
