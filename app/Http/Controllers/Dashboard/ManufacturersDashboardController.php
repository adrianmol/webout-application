<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Manufacturer;
use Illuminate\Http\Request;

class ManufacturersDashboardController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('perPage') ?? 25;
        $manufacturers = Manufacturer::paginate($perPage)->setPath('manufacturers');

        return view('pages.manufacturer.index', ['manufacturers' => $manufacturers]);
    }
}
