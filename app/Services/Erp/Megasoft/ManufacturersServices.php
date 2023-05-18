<?php 

namespace App\Services\Erp\Megasoft;

use Illuminate\Support\Facades\Http;
use App\Constants\Erp\Megasoft\MegasoftConstants;
use App\Models\Manufacturer;

class ManufacturersServices
{
    public function getManufacturers(string $endpoint, string $date = ''): ?array
    {
        $paramForm           = array();
        $prepareManufacturer = array();

        $paramForm = [
            'SiteKey' =>MegasoftConstants::SITE_KEY 
        ];

        $response = Http::asForm()
        ->post(
            MegasoftConstants::URL . $endpoint,
            $paramForm
        );

        if(!$response->ok()){
            return [];
        }

        $manufacturers = collect(json_decode(json_encode((array)simplexml_load_string($response->body())),true)['ManufacturerDetails']);

        if(empty($manufacturers)){
            return [];
        }

        $manufacturers->each(function($manufacturer) use (&$prepareManufacturer){

            $prepareManufacturer[] = [
                'erp_id'    => $manufacturer['ManufacturerID'],
                'name'      => $manufacturer['ManufacturerName'] ?? '',
                'code'      => !empty($manufacturer['ManufacturerCode']) ? $manufacturer['ManufacturerCode'] : '' ,
            ];
            
        });

        Manufacturer::upsert($prepareManufacturer,['erp_id']);

        return $prepareManufacturer;
    }
}