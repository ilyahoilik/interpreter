<?php

declare(strict_types=1);

namespace Interpreter\Parser\AST;

class NullNode implements ConstantNodeInterface
{
    public function __construct(string $operator, NodeInterface ...$operands) {}

    public function getValue(): null
    {
        return null;
    }
}