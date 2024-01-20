<?php

/**
 * This is part of the ascetik/primalvalues package
 *
 * @package    PrimalValues
 * @category   Interface
 * @license    https://opensource.org/license/mit/  MIT License
 * @copyright  Copyright (c) 2023, Vidda
 * @author     Vidda <vidda@ascetik.fr>
 */

declare(strict_types=1);

namespace Ascetik\Primalvalues\Types;

interface PrimalValue
{
    public function equals(mixed $value): bool;
    public function value(): string|int|float;
}
