<?php

namespace App\Services\Erp\Megasoft;

use App\Constants\Erp\Megasoft\MegasoftConstants;
use App\Models\Manufacturer;
use Illuminate\Support\Facades\Http;

class ManufacturersServices
{
    public function getManufacturers(string $endpoint, string $date = ''): ?array
    {
        $paramForm = [];
        $prepareManufacturer = [];

        $paramForm = [
            'SiteKey' => MegasoftConstants::SITE_KEY,
        ];

        $response = Http::asForm()
            ->post(
                MegasoftConstants::URL.$endpoint,
                $paramForm
            );

        if (! $response->ok()) {
            return [];
        }

        $manufacturers = collect(json_decode(json_encode((array) simplexml_load_string($response->body())), true)['ManufacturerDetails']);

        if (! $manufacturers->count()) {
            return [];
        }

        $manufacturers->each(function ($manufacturer) use (&$prepareManufacturer) {

            $prepareManufacturer[] = [
                'erp_manufacturer_id' => $manufacturer['ManufacturerID'],
                'name' => $manufacturer['ManufacturerName'] ?? '',
                'code' => ! empty($manufacturer['ManufacturerCode']) ? $manufacturer['ManufacturerCode'] : '',
            ];
        });

        Manufacturer::upsert($prepareManufacturer, ['erp_manufacturer_id']);

        return $prepareManufacturer;
    }
}
