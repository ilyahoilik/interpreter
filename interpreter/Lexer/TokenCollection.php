<?php

declare(strict_types=1);

namespace Interpreter\Lexer;

class TokenCollection implements TokenCollectionInterface
{
    private array $container = [];

    private int $length = 0;

    private int $pointer = 0;

    public function getAll(): array
    {
        return $this->container;
    }

    public function add(TokenInterface $token): void
    {
        $this->container[] = $token;
        $this->length++;
    }

    public function getPointer(): int
    {
        return $this->pointer;
    }

    public function current(): TokenInterface
    {
        return $this->container[$this->pointer];
    }

    public function next(): TokenInterface|false
    {
        if ($this->pointer + 1 === $this->length) {
            return false;
        }

        return $this->container[++$this->pointer];
    }

    public function prev(): TokenInterface|false
    {
        if ($this->pointer === 0) {
            return false;
        }

        return $this->container[--$this->pointer];
    }

    public function reset(): void
    {
        $this->pointer = 0;
    }
}