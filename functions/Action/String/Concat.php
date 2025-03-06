<?php

declare(strict_types=1);

namespace Bk\Action\String;

class Concat
{
    public function __invoke(string $left, string $right): string
    {
        return $left . $right;
    }
}