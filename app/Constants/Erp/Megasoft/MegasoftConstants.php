<?php

namespace App\Constants\Erp\Megasoft;

use App\Models\Setting;

class MegasoftConstants
{
    public const ERP_URL = 'erp.url';

    public const SITE_KEY = 'erp.key';
    
    public static function getMegasoftUrl()
    {

        $storeUrl = Setting::where('key', self::ERP_URL)?->get('value')?->first()?->value;

        if (! isset($storeUrl)) {
            throw new \Exception('No initialized store data');
        }

        return $storeUrl;
    }

    public static function getMegasoftSiteKey()
    {
        $storeKey = Setting::where('key', self::SITE_KEY)?->get('value')?->first()?->value;

        if (! isset($storeKey)) {
            throw new \Exception('No initialized store data');
        }

        return $storeKey;
    }
}
