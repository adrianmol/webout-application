<?php

namespace App\Http\Controllers\Api\Opencart;

use App\Http\Controllers\Controller;
use App\Services\Store\Opencart\ProductsService;
use Illuminate\Http\Request;

class ProductOpencartController extends Controller
{
    private static string $endpoint = '/prismaProducts';

    protected ProductsService $productsService;

    public function __construct(
        ProductsService $productsService
    ) {
        $this->productsService = $productsService;
    }

    public function index(Request $request)
    {
        $date = $request->input('date') ?? null;

        $products = $this->productsService->getProductsForOpencart($date);

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
