<?php

declare(strict_types=1);

namespace Ascetik\Primalvalues\Values;

use Ascetik\Primalvalues\Types\PrimalValue;

class PrimalString implements PrimalValue
{
    public function __construct(private readonly string $value)
    {
    }

    public function concat(string ...$adds): self
    {
        $phrase = $this->value;
        foreach ($adds as $string) {
            $phrase .= $string;
        }
        return new self($phrase);
    }

    public function concatWithSpaces(string ...$adds): self
    {
        $words = array_map(fn (string $string) => ' ' . $string, $adds);
        return $this->concat(...$words);
        // $phrase = $this->value;
        // foreach ($adds as $string) {
        //     $phrase .= ' ' . $string;
        // }
        // return new self($phrase);
    }


    public function equals(mixed $value):bool
    {
        return $this->value === $value;
    }

    public function value(): string
    {
        return $this->value;
    }
}
