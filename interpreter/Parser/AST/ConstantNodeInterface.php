<?php

declare(strict_types=1);

namespace Interpreter\Parser\AST;

interface ConstantNodeInterface extends NodeInterface
{
    public function getValue(): mixed;
}