<?php

declare(strict_types=1);

namespace Interpreter\Lexer\Tokens;

use Interpreter\Lexer\Token;

class FalseToken extends Token
{
    public static function getToken(): string|false
    {
        return 'false';
    }
}