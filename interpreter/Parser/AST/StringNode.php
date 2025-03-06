<?php

declare(strict_types=1);

namespace Interpreter\Parser\AST;

class StringNode implements ConstantNodeInterface
{
    private string $value;

    public function __construct(string $operator, NodeInterface ...$operands)
    {
        $this->value = $operator;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}