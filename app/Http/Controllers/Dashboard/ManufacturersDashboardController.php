<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Manufacturer;
use Illuminate\Pagination\Paginator;

class ManufacturersDashboardController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('perPage') ?? 25;
        $manufacturers = Manufacturer::paginate($perPage)->setPath('manufacturers');

        return view('pages.manufacturer.index', [ 'manufacturers' => $manufacturers]);
    }
}
