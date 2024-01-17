<?php

declare(strict_types=1);

namespace Ascetik\Primalvalues\Types;

interface PrimalValue
{
    public function equals(mixed $value): bool;
    public function value(): string|int|float;
}
