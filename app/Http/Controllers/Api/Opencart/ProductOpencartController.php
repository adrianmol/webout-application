<?php

namespace App\Http\Controllers\Api\Opencart;

use App\Http\Controllers\Controller;
use App\Services\Store\Opencart\ProductsService;

class ProductOpencartController extends Controller
{
    private static string $endpoint = '/prismaProducts';

    protected ProductsService $productsService;

    public function __construct(
        ProductsService $productsService
    ) {
        $this->productsService = $productsService;
    }

    public function index()
    {

        $products = $this->productsService->getProductsForOpencart();

        if (empty($products)) {

            return response()->json([
                'code' => 'error',
                'message' => 'No found products',
            ],
                404
            );
        }

        $opencartResponse = $this->productsService->setData(self::$endpoint, $products->toArray());

        return response()->json(
            $opencartResponse
        );
    }
}
