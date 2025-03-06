<?php

declare(strict_types=1);

use App\Application;

require_once 'vendor/autoload.php';

$code = '(bk.action.string.JsonEncode, 
    (bk.action.map.Make, 
        (bk.action.array.Make, "message"), 
        (bk.action.array.Make, 
            (bk.action.string.Concat, "Hello, ", (bk.action.core.GetArg, 0))
        )
    )
)';

echo Application::run($code) . "\n";