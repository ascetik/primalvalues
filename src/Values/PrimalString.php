<?php

declare(strict_types=1);

namespace Ascetik\Primalvalues\Values;

use Ascetik\Hypothetik\Core\Maybe;
use Ascetik\Hypothetik\Core\When;
use Ascetik\Primalvalues\Types\PrimalValue;

class PrimalString implements PrimalValue
{
    private function __construct(private readonly string $value)
    {
    }

    public function charAt(int $index): ?string
    {
        $chars = str_split($this->value);
        return $chars[$index] ?? null;
    }

    public function concat(string|self $string): self
    {
        $str = $this->backToString($string)
            ->then(fn (string $str) => $this->value . $str)
            ->value();
        return new self($str);
    }

    public function contains(string|self $string): bool
    {
        return str_contains($this->value, $this->backToString($string)->value());
    }

    /**
     * @param string|self $string
     *
     * @return Maybe<string>
     */
    private function backToString(string|self $string): Maybe
    {
        return When::ever($string instanceof self)
            ->then(fn (self $primal) => $primal->value(), $string)
            ->otherwise($string);
    }

    public function equals(mixed $value): bool
    {
        return $this->value === $value;
    }

    public function value(): string
    {
        return $this->value;
    }

    public static function of(string $value): self
    {
        return new self($value);
    }
}
