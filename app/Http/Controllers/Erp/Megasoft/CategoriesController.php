<?php

namespace App\Http\Controllers\Erp\Megasoft;

use App\Http\Controllers\Controller;
use App\Services\Erp\Megasoft\CategoriesServices;

class CategoriesController extends Controller
{
    public ?string $endpointCategories = '/GetItemGroups';

    public CategoriesServices $CategoriesServices;

    public function __construct(
        CategoriesServices $CategoriesServices
    ) {
        $this->CategoriesServices = $CategoriesServices;
    }

    public function index()
    {
        $categories = $this->CategoriesServices->createOrUpdateCategories($this->endpointCategories);

        return response()->json([
            'totalItems' => count($categories['updated']) + count($categories['created']),
            'totalUpdated' => count($categories['updated']),
            'totalCreated' => count($categories['created']),
            'data' => $categories,
        ]);
    }
}
