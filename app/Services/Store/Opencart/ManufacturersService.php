<?php

namespace App\Services\Store\Opencart;

use App\Models\Manufacturer;

class ManufacturersService extends OpencartAbstractService
{
    public function getManufacturersForOpencart()
    {

        $manufacturers = Manufacturer::All()->map(function ($manufacturer) {
            return [
                'id' => $manufacturer->id,
                'name' => $manufacturer->name,
                'manufacturer_id' => $manufacturer->erp_manufacturer_id,
                'sort_order' => $manufacturer->sort_order,
                'image' => '',
                'status' => '',
                'code' => $manufacturer->code,
                'updated_at' => $manufacturer->updated_at,
                'created_at' => $manufacturer->created_at,

            ];
        });

        return $manufacturers;
    }
}
