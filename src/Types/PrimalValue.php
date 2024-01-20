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

/**
 * Generic behavior of a
 * primitive type wrapper
 *
 * @version 1.0.0
 */
interface PrimalValue
{
    public function equals(mixed $value): bool;
    public function value(): mixed;
}
