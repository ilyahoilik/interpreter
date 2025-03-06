<?php

declare(strict_types=1);

namespace Bk\Action\Core;

use OutOfRangeException;

class GetArg
{
    public function __invoke(int $arg): string
    {
        if (array_key_exists(++$arg, $_SERVER['argv'])) {
            return $_SERVER['argv'][$arg];
        }

        throw new OutOfRangeException('Argument #' . $arg . ' is missing');
    }
}