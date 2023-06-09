<?php

namespace App\Http\Controllers\Api\Opencart;

use App\Http\Controllers\Controller;
use App\Services\Store\Opencart\ManufacturersService;

class ManufacturerOpencartController extends Controller
{
    private static string $endpoint = '/prismaManufacturers';

    protected ManufacturersService $manufacturersService;

    public function __construct(
        ManufacturersService $manufacturersService
    ) {
        $this->manufacturersService = $manufacturersService;
    }

    public function index()
    {

        $manufacturers = $this->manufacturersService->getManufacturersForOpencart();

        if (empty($manufacturers)) {

            return response()->json([
                'code' => 'error',
                'message' => 'No found manufacturers',
            ],
                404
            );
        }

        $opencartResponse = $this->manufacturersService->setData(self::$endpoint, $manufacturers->toArray());

        return response()->json(
            $opencartResponse
        );
    }
}
