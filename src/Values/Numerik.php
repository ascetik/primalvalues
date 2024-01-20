<?php

/**
 * This is part of the ascetik/primalvalues package
 *
 * @package    PrimalValues
 * @category   Primitive Value Object
 * @license    https://opensource.org/license/mit/  MIT License
 * @copyright  Copyright (c) 2023, Vidda
 * @author     Vidda <vidda@ascetik.fr>
 */

declare(strict_types=1);

namespace Ascetik\Primalvalues\Values;

use Ascetik\Hypothetik\Core\When;
use Ascetik\Hypothetik\Core\Maybe;
use Ascetik\Primalvalues\Types\PrimalValue;

/**
 * Provide methods to extend numeric values
 *
 * @version 1.0.0
 */
class Numerik implements PrimalValue
{
    public static function of(int|float $number): self
    {
        return new self($number);
    }

    public static function zero(): self
    {
        return new self(0);
    }

    public function add(int|float|self $number): self
    {
        $sum = $this->value + $this->ensureValue($number)->value();
        return new self($sum);
    }

    public function cube(): self
    {
        return $this->power(3);
    }

    public function decrement(int|float|self $decrease = 1): self
    {
        return $this->subtract($decrease);
    }

    public function divides(int|float|self $dividend): self
    {
        if ($this->isZero()) {
            return $this;
        }
        return new self($dividend / $this->value);
    }

    public function dividedBy(int|float|self $divider): self
    {
        if ($divider == 0) {
            return self::zero();
        }
        return new self($this->value / $divider);
    }

    public function equals(mixed $value): bool
    {
        return $value === $this->value;
    }

    public function exposing(int|float|self $number): self
    {
        $value = pow($this->ensureValue($number)->value(), $this->value);
        return new self($value);
    }

    public function increment(int|float|self $increase = 1): self
    {
        return $this->add($increase);
    }

    public function isZero(): bool
    {
        return $this->value === 0;
    }

    public function multiply(int|float|self $number): self
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

    public function subtract(int|float|self $number): self
    {
        $difference = $this->value - $this->ensureValue($number)->value();
        return new self($difference);
    }

    public function subtractTo(int|float|self $number): self
    {
        $difference = $this->ensureValue($number)->value() - $this->value;
        return new self($difference);
    }

    public function toFloat(): float
    {
        return (float) $this->value;
    }

    public function toInteger(): int
    {
        return (int) $this->value;
    }

    public function value(): int|float
    {
        return $this->value;
    }

    private function __construct(private readonly int|float $value)
    {
    }

    /**
     * @param int|static $int
     *
     * @return Maybe<int>
     */
    private function ensureValue(int|float|self $number): Maybe
    {
        return When::ever($number instanceof self)
            ->then(fn (self $primal) => $primal->value(), $number)
            ->otherwise($number);
    }
}
