<?php

declare(strict_types=1);

namespace Bk\Action\Array;

class Make
{
    public function __invoke(mixed ...$params): array
    {
        return $params;
    }
}