<?php

declare(strict_types=1);

namespace Interpreter\Lexer;

use Interpreter\Lexer\Tokens\Comma;
use Interpreter\Lexer\Tokens\Identifier;
use Interpreter\Lexer\Tokens\IntegerToken;
use Interpreter\Lexer\Tokens\LeftParenthesis;
use Interpreter\Lexer\Tokens\RightParenthesis;
use Interpreter\Lexer\Tokens\StringToken;
use InvalidArgumentException;

class Lexer implements LexerInterface
{
    private ReaderInterface $reader;

    private TokenCollectionInterface $tokenCollection;

    private static array $availableTokens = [
        LeftParenthesis::class,
        RightParenthesis::class,
        Comma::class,
        IntegerToken::class,
        Identifier::class,
        StringToken::class,
    ];

    public function __construct(
        ReaderInterface          $reader,
        TokenCollectionInterface $tokenCollection,
    )
    {
        $this->reader = $reader;
        $this->tokenCollection = $tokenCollection;
    }

    private function getReader(): ReaderInterface
    {
        return $this->reader;
    }

    public function getTokens(): TokenCollectionInterface
    {
        return $this->tokenCollection;
    }

    private function isWhitespace(): bool
    {
        return (bool) preg_match('/^\s$/', $this->getReader()->getChar());
    }

    public function lex(): static
    {
        $this->processChars();

        return $this;
    }

    private function processChars(): void
    {
        do {
            $this->processChar();
        } while ($this->getReader()->nextChar() !== false);
    }

    private function processChar(): void
    {
        if ($this->isWhitespace()) {
            return;
        }

        foreach (static::$availableTokens as $tokenClass) {
            if (!is_subclass_of($tokenClass, TokenInterface::class)) {
                throw new InvalidArgumentException('Token class must be an instance of ' . TokenInterface::class);
            }

            if ($tokenClass::validate($this->reader)) {
                $token = $tokenClass::retrieve($this->reader);

                $this->getTokens()->add($token);

                return;
            }
        }
    }
}