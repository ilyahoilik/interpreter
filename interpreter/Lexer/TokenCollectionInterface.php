<?php

declare(strict_types=1);

namespace Interpreter\Lexer;

interface TokenCollectionInterface
{
    public function getAll(): array;

    public function add(TokenInterface $token): void;

    public function current(): TokenInterface;

    public function next(): TokenInterface|false;

    public function prev(): TokenInterface|false;

    public function reset(): void;
}