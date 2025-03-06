<?php

declare(strict_types=1);

namespace Bk\Action\Map;

class Make
{
    public function __invoke(array $keys, array $values): array
    {
        return array_combine($keys, $values);
    }
}