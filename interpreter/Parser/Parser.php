<?php

declare(strict_types=1);

namespace Interpreter\Parser;

use Interpreter\Lexer\TokenCollectionInterface;
use Interpreter\Lexer\TokenInterface;
use Interpreter\Lexer\Tokens\Comma;
use Interpreter\Lexer\Tokens\FalseToken;
use Interpreter\Lexer\Tokens\Identifier;
use Interpreter\Lexer\Tokens\IntegerToken;
use Interpreter\Lexer\Tokens\LeftParenthesis;
use Interpreter\Lexer\Tokens\NullToken;
use Interpreter\Lexer\Tokens\RightParenthesis;
use Interpreter\Lexer\Tokens\StringToken;
use Interpreter\Lexer\Tokens\TrueToken;
use Interpreter\Parser\AST\BooleanNode;
use Interpreter\Parser\AST\FunctionNode;
use Interpreter\Parser\AST\FunctionNodeInterface;
use Interpreter\Parser\AST\NodeInterface;
use Interpreter\Parser\AST\NullNode;
use Interpreter\Parser\AST\NumberNode;
use Interpreter\Parser\AST\StringNode;
use LogicException;

class Parser implements ParserInterface
{
    private TokenCollectionInterface $tokenCollection;

    private FunctionNodeInterface $app;

    public function __construct(
        TokenCollectionInterface $tokenCollection,
        FunctionNodeInterface    $app,
    )
    {
        $this->tokenCollection = $tokenCollection;
        $this->app = $app;
    }

    public function getAbstractStaticThree(): FunctionNodeInterface
    {
        return $this->app;
    }

    public function parse(): static
    {
        $tokens = $this->tokenCollection;

        if (!$tokens->current() instanceof LeftParenthesis) {
            throw new LogicException('Expected left parenthesis');
        }

        $this->app->addOperand($this->parseFunction());

        return $this;
    }

    private function parseFunction(): FunctionNode
    {
        $tokens = $this->tokenCollection;
        $operator = $tokens->next();
        if (!$operator instanceof Identifier) {
            throw new LogicException('Unsupported operator');
        }

        $token = $tokens->next();
        if ($token instanceof RightParenthesis) {
            return new FunctionNode($operator->getValue());
        } elseif (!$token instanceof Comma) {
            throw new LogicException('Expected comma or right parenthesis');
        }

        $operands = [];

        while ($token instanceof Comma) {
            $token = $tokens->next();

            if ($token instanceof LeftParenthesis) {
                $operands[] = $this->parseFunction();
            } else {
                $operands[] = $this->handleToken($token);
            }

            $token = $tokens->next();
        }

        if (!$token instanceof RightParenthesis) {
            throw new LogicException('Expected right parenthesis');
        }

        return new FunctionNode($operator->getValue(), ...$operands);
    }

    private function handleToken(TokenInterface $token): NodeInterface
    {
        return match (get_class($token)) {
            FalseToken::class => new BooleanNode('false'),
            IntegerToken::class => new NumberNode($token->getValue()),
            NullToken::class => new NullNode('null'),
            StringToken::class => new StringNode($token->getValue()),
            TrueToken::class => new BooleanNode('true'),
        };
    }
}