<?php

declare(strict_types=1);

namespace Interpreter\Parser\AST;

class NumberNode implements ConstantNodeInterface
{
    private int|float $value;

    public function __construct(string $operator, NodeInterface ...$operands)
    {
        $value = str_replace(' ', '', $operator);

        if (str_contains($value, '.')) {
            $number = floatval($value);
        } else {
            $number = intval($value);
        }

        $this->value = $number;
    }

    public function getValue(): int|float
    {
        return $this->value;
    }
}