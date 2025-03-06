<?php

declare(strict_types=1);

namespace Interpreter\Lexer\Tokens;

use Interpreter\Lexer\Reader;
use Interpreter\Lexer\Token;
use Interpreter\Lexer\TokenInterface;

class Identifier extends Token
{
    public static function validate(Reader $reader): bool
    {
        return (bool) preg_match('/^[A-Za-z_]$/', $reader->getChar());
    }

    public static function retrieve(Reader $reader): TokenInterface
    {
        $output = "";
        $char = $reader->getChar();

        while (preg_match('/^[A-Za-z._-]$/i', $char)) {
            $output .= $char;
            $char = $reader->nextChar();
        }

        $reader->prevChar();

        $tokenClass = match ($output) {
            'true' => TrueToken::class,
            'false' => FalseToken::class,
            'null' => NullToken::class,
            default => static::class,
        };

        return new $tokenClass($output);
    }
}