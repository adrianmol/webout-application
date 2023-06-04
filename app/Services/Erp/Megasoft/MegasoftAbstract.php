<?php

namespace App\Services\Erp\Megasoft;

use App\Constants\Erp\Megasoft\MegasoftConstants;
use Illuminate\Support\Facades\Http;

abstract class MegasoftAbstract
{
    public function getData(string $endpoint, array $params, string $returnKey = '')
    {

        if (empty($endpoint) || empty($params)) {
            return collect();
        }

        $response = Http::asForm()
            ->post(
                MegasoftConstants::URL.$endpoint,
                $params
            );

        if (! $response->ok()) {
            return collect();
        }

        $data = json_decode(json_encode((array) simplexml_load_string($response->body())), true);

        if (empty($data)) {
            return collect();
        }

        if (empty($returnKey)) {
            return collect($data);
        } else {

            $data = $data[$returnKey];

            if (! isset($data[0])) {
                return collect([$data]);
            }

            return collect($data);
        }
    }
}
