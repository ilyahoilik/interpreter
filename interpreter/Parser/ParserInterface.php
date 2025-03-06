<?php

declare(strict_types=1);

namespace Interpreter\Parser;

use Interpreter\Lexer\TokenCollectionInterface;
use Interpreter\Parser\AST\FunctionNodeInterface;

interface ParserInterface
{
    public function __construct(
        TokenCollectionInterface $tokenCollection,
        FunctionNodeInterface    $appNode,
    );

    public function getAbstractStaticThree(): FunctionNodeInterface;

    public function parse(): static;
}