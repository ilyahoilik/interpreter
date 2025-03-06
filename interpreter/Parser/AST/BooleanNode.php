<?php

declare(strict_types=1);

namespace Interpreter\Parser\AST;

use InvalidArgumentException;

class BooleanNode implements ConstantNodeInterface
{
    private bool $value;

    public function __construct(string $operator, NodeInterface ...$operands)
    {
        if (mb_strtolower($operator) === 'true') {
            $this->value = true;
        } elseif (mb_strtolower($operator) === 'false') {
            $this->value = false;
        } else {
            throw new InvalidArgumentException('Invalid boolean value: ' . $operator);
        }
    }

    public function getValue(): bool
    {
        return $this->value;
    }
}