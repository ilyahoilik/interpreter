<?php

declare(strict_types=1);

namespace Bk\Action\String;

class JsonEncode
{
    public function __invoke(array $data): string
    {
        return json_encode($data);
    }
}