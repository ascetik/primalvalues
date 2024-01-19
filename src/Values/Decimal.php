<?php

declare(strict_types=1);

namespace Ascetik\Primalvalues\Values;

use Ascetik\Primalvalues\Traits\NumerikValue;
use Ascetik\Primalvalues\Types\Numerik;

class Decimal implements Numerik
{
    use NumerikValue;

    private function __construct(private readonly float $value)
    {

    }

    public function equals(mixed $value): bool
    {
        return is_float($value) && $value == $this->value;
    }

}
