<?php

namespace App\Constants;

use App\Models\Setting;

class OpencartConstants
{
    private const STORE_URL = 'store.url';

    public const TOKEN_KEY = 'store.key';

    public static function getOpencartUrl()
    {

        $storeUrl = Setting::where('key', self::STORE_URL)?->get('value')?->first()?->value;

        if (! isset($storeUrl)) {
            throw new \Exception('No initialized store data');
        }

        return $storeUrl;
    }

    public static function getOpencartTokenKey()
    {
        $storeKey = Setting::where('key', self::TOKEN_KEY)?->get('value')?->first()?->value;

        if (! isset($storeKey)) {
            throw new \Exception('No initialized store data');
        }

        return $storeKey;
    }
}
