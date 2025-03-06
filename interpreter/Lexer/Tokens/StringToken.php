<?php

declare(strict_types=1);

namespace Interpreter\Lexer\Tokens;

use Interpreter\Lexer\Reader;
use Interpreter\Lexer\Token;
use Interpreter\Lexer\TokenInterface;

class StringToken extends Token
{
    public static function validate(Reader $reader): bool
    {
        return $reader->charIs('"');
    }

    public static function retrieve(Reader $reader): TokenInterface
    {
        $output = "";
        $prevChar = $reader->getChar();
        $char = $reader->nextChar();

        while ($char !== false && ($char !== '"' || $prevChar === '\\')) {
            $output .= $char;

            $prevChar = $reader->getChar();
            $char = $reader->nextChar();
        }

        return new static($output);
    }
}