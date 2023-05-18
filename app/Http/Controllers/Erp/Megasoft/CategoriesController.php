<?php

namespace App\Http\Controllers\Erp\Megasoft;

use App\Http\Controllers\Controller;
use App\Services\Erp\Megasoft\CategoriesServices;
use Illuminate\Support\Facades\Http;

class CategoriesController extends Controller
{
    public ?string $endpointCategories = '/GetItemGroups';
    public CategoriesServices $CategoriesServices;

    public function __construct
    (
        CategoriesServices $CategoriesServices
    )
    {
        $this->CategoriesServices = $CategoriesServices;
    }

    public function index()
    {
        $categories = $this->CategoriesServices->getCategories($this->endpointCategories);

        return response()->json([
            'totalItems' => count($categories),
            'data'       => $categories
        ]);
    }
}