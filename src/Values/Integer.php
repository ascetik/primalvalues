<?php

declare(strict_types=1);

namespace Ascetik\Primalvalues\Values;

use Ascetik\Hypothetik\Core\When;
use Ascetik\Hypothetik\Core\Maybe;
use Ascetik\Primalvalues\Traits\NumerikValue;
use Ascetik\Primalvalues\Types\Numerik;
use Ascetik\Primalvalues\Values\NonZero;

class Integer implements Numerik
{
    use NumerikValue;

    public function decrement(int|self $increase = 1): self
    {
        $value = $this->value - $this->ensureValue($increase)->value();
        return new self($value);
    }

    public function equals(mixed $value): bool
    {
        return is_integer($value) && $value == $this->value;
    }

    public function increment(int|self $increase = 1): self
    {
        $value = $this->value + $this->ensureValue($increase)->value();
        return new self($value);
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
}
