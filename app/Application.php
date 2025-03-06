<?php

declare(strict_types=1);

namespace App;

use Interpreter\Evaluator\Evaluator;
use Interpreter\Evaluator\EvaluatorInterface;
use Interpreter\Lexer\EmptyInputException;
use Interpreter\Lexer\Lexer;
use Interpreter\Lexer\LexerInterface;
use Interpreter\Lexer\Reader;
use Interpreter\Lexer\ReaderInterface;
use Interpreter\Lexer\TokenCollection;
use Interpreter\Lexer\TokenCollectionInterface;
use Interpreter\Parser\AST\FunctionNode;
use Interpreter\Parser\AST\FunctionNodeInterface;
use Interpreter\Parser\Parser;
use Interpreter\Parser\ParserInterface;

class Application
{
    public static function run(string $code): string
    {
        $app = new static();

        $reader = $app->getReader($code);

        $tokenCollection = $app->getTokenCollection();

        $lexer = $app->getLexer($reader, $tokenCollection);

        $lexer->lex();

        $appNode = $app->getFunctionNode();

        $parser = $app->getParser($tokenCollection, $appNode);

        $parser->parse();

        $evaluator = $app->getEvaluator($appNode);

        return $evaluator->evaluate();
    }

    private function getReader(string $code): ReaderInterface
    {
        try {
            return new Reader($code);
        } catch (EmptyInputException $e) {
            $this->error($e->getMessage());
        }
    }

    private function getTokenCollection(): TokenCollectionInterface
    {
        return new TokenCollection();
    }

    private function getLexer(
        ReaderInterface          $reader,
        TokenCollectionInterface $tokenCollection,
    ): LexerInterface
    {
        return new Lexer($reader, $tokenCollection);
    }

    private function getFunctionNode(): FunctionNodeInterface
    {
        return new FunctionNode('app');
    }

    private function getParser(
        TokenCollectionInterface $tokenCollection,
        FunctionNodeInterface    $appNode,
    ): ParserInterface
    {
        return new Parser($tokenCollection, $appNode);
    }

    private function getEvaluator(FunctionNodeInterface $appNode): EvaluatorInterface
    {
        return new Evaluator($appNode);
    }

    private function error(string $message): never
    {
        echo "Error: $message\n";
        exit(1);
    }
}