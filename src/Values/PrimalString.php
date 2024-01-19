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

    public function charAt(int $index): self
    {
        $chars = str_split($this->value);
        return When::ever($index < 0)
            ->then(fn (array $chrs) => array_reverse($chrs), $chars)
            ->otherwise($chars)
            ->then(fn (array $characters) => new self($characters[abs($index)] ?? ''))
            ->value();
        // return new self($chars[abs($index)] ?? '');
    }

    public function concat(string|self $sequence): self
    {
        $str = $this->backToString($sequence)
            ->then(fn (string $str) => $this->value . $str)
            ->value();
        return new self($str);
    }

    public function contains(string|self $sequence): bool
    {
        return str_contains($this->value, $this->backToString($sequence)->value());
    }

    public function endsWith(string|self $sequence): bool
    {
        return str_ends_with($this->value, $this->backToString($sequence)->value());
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

    public function replace(string|self|array $oldStr, string|self|array $newStr): self
    {
        $oldStr = $this->handleReplacement($oldStr);
        $newStr = $this->handleReplacement($newStr);
        return new self(str_replace($oldStr, $newStr, $this->value));
    }

    public function replaceAll(string|array $regex, string|self|array $replacement): self
    {
        $replaced = preg_replace(
            $regex,
            $this->handleReplacement($replacement),
            $this->value
        );
        return Maybe::some($replaced)
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
        return Maybe::some(preg_split($regex, $this->value))
            ->then(fn (array $arr) => $arr)
            ->otherwise([])
            ->value();
    }


    public function startsWith(string|self $string): bool
    {
        return str_starts_with($this->value, $this->backToString($string)->value());
    }

    public function subString(int $offset, ?int $length = null): self
    {
        $sub = substr($this->value, $offset, Maybe::some($length)->value());
        return Maybe::some($sub)

            ->then(self::of(...))
            ->otherwise(self::empty())
            ->value();
    }

    /**
     * @return self[]
     */
    public function toArray(): array
    {
        return array_map(
            fn (string $letter) => new self($letter),
            str_split($this->value)
        );
    }

    public function toLowerCase(): self
    {
        return new self(strtolower($this->value));
    }

    public function toUpperCase(): self
    {
        return new self(strtoupper($this->value));
    }

    public function trim(string|self|null $characters = null)
    {
        $maybe = When::ever(is_null($characters))
            ->either(fn () => trim($this->value))
            ->or(fn (string $chars) => trim($this->value, $this->backToString($chars)->value()), $characters);
        return new self($maybe->value());
    }

    public function value(): string
    {
        return $this->value;
    }


    private function handleReplacement(string|array|self $replacement): array|string
    {
        return match (true) {
            $replacement instanceof self => $replacement->value(),
            is_array($replacement) => array_map(
                fn (string|self $str) => $this->backToString($str)->value(),
                $replacement
            ),
            default => $replacement
        };
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

    public static function empty(): self
    {
        return new self('');
    }

    public static function of(string $sequence): self
    {
        return new self($sequence);
    }
}
