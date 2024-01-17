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

    public function equals(mixed $value): bool
    {
        return When::ever($value instanceof self)
            ->either(fn (self $string) => $this->value == $string->value, $value)
            ->or(fn () => $this->value === $value, $value)
            ->try()
            ->value();
    }

    public function indexOf(string|self $sequence): int
    {
        $maybe = $this->backToString($sequence)
            ->then(fn ($string) => strpos($this->value, $string))
            ->then(fn (int $index) => $index)
            ->otherwise(-1);
        return $maybe->value();
    }

    public function isEmpty(): bool
    {
        return empty($this->value);
    }

    public function lastIndexOf(string|self $sequence): int
    {
        $maybe = $this->backToString($sequence)
            ->then(fn ($string) => strrpos($this->value, $string))
            ->then(fn (int $index) => $index)
            ->otherwise(-1);
        return $maybe->value();
    }

    public function length(): int
    {
        return strlen($this->value);
    }

    public function matches(string $regex): bool
    {
        return (bool) preg_match($regex, $this->value);
    }

    public function replace(string|self $oldStr, string|self $newStr): self
    {
        $oldStr = $this->backToString($oldStr)->value();
        $newStr = $this->backToString($newStr)->value();
        if ($this->contains($oldStr)) {
            return new self(str_replace($oldStr, $newStr, $this->value));
        }
        return $this;
    }

    public function replaceAll(string|array $regex, string|self|array $replacement): self
    {
        if ($replacement instanceof self) {
            $replacement = $replacement->value();
        }
        if (is_array($replacement)) {
            $replacement = array_map(
                function (string|self $str) {
                    return $str instanceof self
                        ? $str->value()
                        : $str;
                },
                $replacement
            );
        }
        return Maybe::some(preg_replace($regex, $replacement, $this->value))
            ->then(function (string $result) {
                return $this->equals($result)
                    ? $this
                    : new self($result);
            })
            ->otherwise($this)
            ->value();
    }

    public function split(string $regex): array
    {
        $split = preg_split($regex, $this->value);
        var_dump($split);
        return Maybe::some($split)
            ->then(fn (array $arr) => $arr)
            ->otherwise([])
            ->value();
    }

    public function value(): string
    {
        return $this->value;
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

    public static function of(string $value): self
    {
        return new self($value);
    }
}
