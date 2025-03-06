<?php

declare(strict_types=1);

namespace Interpreter\Lexer;

abstract class Token implements TokenInterface
{
    protected mixed $value;

    public function __construct(string|null $value = null)
    {
        $this->setValue($value);
    }

    public static function getToken(): string|false
    {
        return false;
    }

    public function getValue(): string|null
    {
        return $this->value;
    }

    public function setValue(string|null $value): static
    {
        $this->value = $value;

        return $this;
    }

    public static function validate(Reader $reader): bool
    {
        return $reader->charIs(static::getToken());
    }

    public static function retrieve(Reader $reader): TokenInterface
    {
        return new static(static::getToken());
    }
}