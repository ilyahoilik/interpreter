<?php

declare(strict_types=1);

namespace Interpreter\Lexer;

class Reader implements ReaderInterface
{
    private array $input;

    private int $length;

    private int $position = 0;

    /**
     * @throws EmptyInputException
     */
    public function __construct(string $input)
    {
        $this->setInput($input);
    }

    /**
     * @throws EmptyInputException
     */
    public function setInput(string $input): static
    {
        if (mb_strlen($input) < 1) {
            throw new EmptyInputException('Input cannot be empty');
        }

        $this->input = mb_str_split($input);
        $this->length = count($this->input);

        return $this;
    }

    public function getChar(): string
    {
        return $this->input[$this->position];
    }

    public function getPrevChar(): string|false
    {
        return $this->input[$this->position - 1] ?? false;
    }

    public function getNextChar(): string|false
    {
        return $this->input[$this->position + 1] ?? false;
    }

    public function charIs(string $char): bool
    {
        return $this->getChar() === $char;
    }

    public function prevCharIs(string $char): bool
    {
        return $this->getPrevChar() === $char;
    }

    public function nextCharIs(string $char): bool
    {
        return $this->getNextChar() === $char;
    }

    public function prevChar(): string|false
    {
        if ($this->position === 0) {
            return false;
        }

        $this->position--;

        return $this->getChar();
    }

    public function nextChar(): string|false
    {
        if ($this->position + 1 === $this->length) {
            return false;
        }

        $this->position++;

        return $this->getChar();
    }
}