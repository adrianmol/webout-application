<?php

namespace App\Http\Controllers\Erp\Megasoft;

use App\Http\Controllers\Controller;
use App\Services\Erp\Megasoft\ManufacturersServices;
use Illuminate\Support\Facades\Http;

class ManufacturersController extends Controller
{
    public ?string $endpointManufacturers = '/GetManufacturers';
    public ManufacturersServices $manufacturersServices;

    public function __construct
    (
        ManufacturersServices $manufacturersServices
    )
    {
        $this->manufacturersServices = $manufacturersServices;
    }

    public function index()
    {

    }

    public function getData()
    {
        $manuf = $this->manufacturersServices->getManufacturers($this->endpointManufacturers);

        return response()->json([
            'totalItems' => count($manuf),
            'data'       => $manuf
        ]);
    }
}