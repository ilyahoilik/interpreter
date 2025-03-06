<?php

declare(strict_types=1);

namespace Interpreter\Parser\AST;

interface NodeInterface
{
    public function __construct(string $operator, NodeInterface ...$operands);
}