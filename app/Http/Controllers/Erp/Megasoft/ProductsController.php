<?php

namespace App\Http\Controllers\Erp\Megasoft;

ini_set('max_execution_time', 300);

use App\Http\Controllers\Controller;
use App\Services\Erp\Megasoft\ProductsServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ProductsController extends Controller
{
    public ?string $endpointProducts = '/GetProducts';

    public ProductsServices $productsServices;

    public function __construct(
        ProductsServices $productsServices
    ) {
        $this->productsServices = $productsServices;
    }

    public function index(Request $request)
    {

        $date = $request->input('date') ?? null;

        $products = $this->productsServices->createOrUpdateProducts($this->endpointProducts, $date);

        //$addresses = 'adrian.mol@hotmail.com';

        // Mail::raw('test' , function ($m) use ($addresses) {
        //     $m->to($addresses)->subject('subject');
        // });

        return response()->json([
            'totalItems' => count($products['updated']) + count($products['created']),
            'totalUpdated' => count($products['updated']),
            'totalCreated' => count($products['created']),
            'data' => $products,
        ]);
    }
}
