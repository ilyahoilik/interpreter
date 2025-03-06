<?php

declare(strict_types=1);

namespace Interpreter\Parser\AST;

interface FunctionNodeInterface extends NodeInterface
{
    public function getOperator(): string;

    public function getOperands(): array|false;

    public function addOperand(NodeInterface $node): void;
}