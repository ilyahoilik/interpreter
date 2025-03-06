<?php

declare(strict_types=1);

namespace Interpreter\Lexer\Tokens;

use Interpreter\Lexer\Reader;
use Interpreter\Lexer\Token;

class IntegerToken extends Token
{
    public static function validate(Reader $reader): bool
    {
        return (bool) preg_match('/^\d$/', $reader->getChar());
    }

    public static function retrieve(Reader $reader): static
    {
        $output = "";
        $char = $reader->getChar();

        while (preg_match('/^[\d. ]$/', $char)) {
            $output .= $char;
            $char = $reader->nextChar();
        }

        $reader->prevChar();

        return new static($output);
    }
}