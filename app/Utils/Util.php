<?php

namespace App\Utils;

use Illuminate\Support\Str;

class Util
{
    public static function isEmpty(array|string $data): ?string
    {
        if (! isset($data)) {
            return null;
        } elseif (empty($data)) {
            return null;
        }

        return $data;
    }

    public static function isEnable(string $value): int
    {

        if (! isset($value)) {
            return 0;
        } elseif (Str::lower($value) == 'true') {
            return 0;
        } else {
            return 1;
        }
    }
}
