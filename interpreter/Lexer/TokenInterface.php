<?php

declare(strict_types=1);

namespace Interpreter\Lexer;

interface TokenInterface
{
    public function __construct(string|null $value = null);

    public static function getToken(): string|false;

    public function getValue(): string|null;

    public function setValue(string|null $value): static;

    public static function validate(Reader $reader): bool;

    public static function retrieve(Reader $reader): TokenInterface;
}