<?php

namespace App\Services\Opencart;

use App\Constants\OpencartConstants;
use Illuminate\Support\Facades\Http;

abstract class OpencartAbstractService
{
    public function getData(string $endpoint, array $params, string $returnKey = '')
    {

        if (empty($endpoint) || empty($params)) {
            return collect();
        }

        $response = Http::asForm()
            ->post(
                OpencartConstants::getOpencartUrl().$endpoint,
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

    public function setData(string $endpoint, array $params)
    {
        if (empty($endpoint) || empty($params)) {
            return collect();
        }
        $data = json_encode($params);

        $response = Http::asForm()
            ->withHeaders([
                'X-OC-RESTADMIN-ID' => OpencartConstants::getOpencartTokenKey(),
                'Content-Type' => 'application/json',
            ])
            ->send(
                'POST',
                OpencartConstants::getOpencartUrl().$endpoint,
                ['body' => $data]
            );

        if (! $response->ok()) {
            return collect();
        }

        $data = json_decode($response->body(), true);

        if (empty($data)) {
            return collect();
        }

        return collect($data);
    }
}
