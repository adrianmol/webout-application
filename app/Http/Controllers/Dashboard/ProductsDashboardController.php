<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class ProductsDashboardController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('perPage') ?? 25;

        $products = Product::paginate($perPage)->setPath('products');

        return view('pages.product.index', ['products' => $products]);
    }

    public function show($id)
    {

        $product = Product::whereId($id)->first();
        $title = $product->descriptions()->first()->name ?? 'Not found';

        $category = Category::find($product->id)->first();

        return view('pages.product.show',
            [
                'product' => $product,
                'category' => $category,
                'title' => $title,
            ]);
    }

    public function runProductsErpJob(Request $request)
    {

        Artisan::queue('app:products 2023-01-01');

        return response()->json(
            [
                'request' => $request->all(),
                'message' => 'The product process has started',
            ]);
    }
}
