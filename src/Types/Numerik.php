<?php

declare(strict_types=1);

namespace Ascetik\Primalvalues\Types;

use Ascetik\Primalvalues\Values\NonZero;

interface Numerik extends PrimalValue
{
    public function add(int|self $number): self;
    public function subtract(int|self $number): self;
    public function multiply(int|self $number): self;
    public function divide(int|self $number): self;
}
