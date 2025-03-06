<?php

declare(strict_types=1);

namespace Interpreter\Lexer;

interface LexerInterface
{
    public function __construct(
        ReaderInterface          $reader,
        TokenCollectionInterface $tokenCollection,
    );

    public function lex(): static;

    public function getTokens(): TokenCollectionInterface;
}