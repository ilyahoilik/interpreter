<?php

declare(strict_types=1);

namespace Interpreter\Lexer;

interface ReaderInterface
{
    public function __construct(string $input);

    public function setInput(string $input): static;

    public function getChar(): string;

    public function getPrevChar(): string|false;

    public function getNextChar(): string|false;

    public function prevChar(): string|false;

    public function nextChar(): string|false;

    public function charIs(string $char): bool;

    public function prevCharIs(string $char): bool;

    public function nextCharIs(string $char): bool;
}