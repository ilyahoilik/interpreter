<?php

declare(strict_types=1);

namespace Interpreter\Evaluator;

use Interpreter\Parser\AST\ConstantNodeInterface;
use Interpreter\Parser\AST\FunctionNodeInterface;
use LogicException;

class Evaluator implements EvaluatorInterface
{
    private FunctionNodeInterface $app;

    public function __construct(FunctionNodeInterface $app)
    {
        $this->app = $app;
    }

    public function evaluate(): mixed
    {
        $rootFunction = $this->app->getOperands()[0];

        if (!$rootFunction instanceof FunctionNodeInterface) {
            throw new LogicException('Root node must contain an instance of ' . FunctionNodeInterface::class);
        }

        return $this->evaluateNode($rootFunction);
    }

    private function evaluateNode(FunctionNodeInterface $node): mixed
    {
        $operands = [];
        foreach ($node->getOperands() as $operand) {
            if ($operand instanceof FunctionNodeInterface) {
                $operands[] = $this->evaluateNode($operand);
            } elseif ($operand instanceof ConstantNodeInterface) {
                $operands[] = $operand->getValue();
            } else {
                throw new LogicException('Operand must either be an instance of ' . ConstantNodeInterface::class . ' or ' . FunctionNodeInterface::class);
            }
        }

        $className = $this->getClassName($node);

        return new $className()(...$operands);
    }

    private function getClassName(FunctionNodeInterface $node): string
    {
        $class = ucwords($node->getOperator(), " \t\r\n\f\v-_.");
        $class = str_replace([' ', '-', '_'], '', $class);

        return str_replace('.', '\\', $class);
    }
}