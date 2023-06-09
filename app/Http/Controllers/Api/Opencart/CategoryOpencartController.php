<?php

namespace App\Http\Controllers\Api\Opencart;

use App\Http\Controllers\Controller;
use App\Services\Store\Opencart\CategoriesService;

class CategoryOpencartController extends Controller
{
    private static string $endpoint = '/prismaCategories';

    protected CategoriesService $categoriesService;

    public function __construct(
        CategoriesService $categoriesService
    ) {
        $this->categoriesService = $categoriesService;
    }

    public function index()
    {

        $categories = $this->categoriesService->getCategoriesForOpencart();

        if (empty($categories)) {

            return response()->json([
                'code' => 'error',
                'message' => 'No found categories',
            ],
                404
            );
        }

        $opencartResponse = $this->categoriesService->setData(self::$endpoint, $categories->toArray());

        return response()->json(
            $opencartResponse
        );
    }
}
