<?php

namespace App\Services\Opencart;

use App\Constants\Opencart;
use Illuminate\Support\Facades\Http;
use App\Models\Manufacturer;
use App\Constants\OpencartConstants;


class ManufacturersService extends OpencartAbstractService
{
    public function getManufacturersForOpencart()
    {

        $manufacturers = Manufacturer::All()->map(function ($manufacturer){
            return  [
                'id'            => $manufacturer->id,
                'name'          => $manufacturer->name,
                'manufacturer_id' => $manufacturer->erp_manufacturer_id,
                'sort_order'    => $manufacturer->sort_order,
                'image'         => '',
                'status'        => '',
                'code'          => $manufacturer->code,
                'updated_at'    => $manufacturer->updated_at,
                'created_at'    => $manufacturer->created_at

            ];
        });

        return $manufacturers;
    }
}