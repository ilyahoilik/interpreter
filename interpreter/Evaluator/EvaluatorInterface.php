<?php

declare(strict_types=1);

namespace Interpreter\Evaluator;

use Interpreter\Parser\AST\FunctionNodeInterface;

interface EvaluatorInterface
{
    public function __construct(FunctionNodeInterface $app);

    public function evaluate(): mixed;
}