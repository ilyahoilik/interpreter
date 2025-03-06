<?php

declare(strict_types=1);

namespace Interpreter\Parser\AST;

class FunctionNode implements FunctionNodeInterface
{
    private string $operator;

    private array $operands;

    public function __construct(string $operator, NodeInterface ...$operands)
    {
        $this->operator = $operator;
        $this->operands = $operands;
    }

    public function getOperator(): string
    {
        return $this->operator;
    }

    public function getOperands(): array|false
    {
        return $this->operands;
    }

    public function addOperand(NodeInterface $node): void
    {
        $this->operands[] = $node;
    }
}