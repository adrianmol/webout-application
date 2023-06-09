<?php

namespace App\Services\Store\Opencart;

use App\Models\Product;

class ProductsService extends OpencartAbstractService
{
    public function getProductsForOpencart(string $date = NULL)
    {
        
        $date = $date ?: date('m-d-Y H:m', strtotime('-4 hours'));

        $products = Product::where('updated_at', '>=', $date)->get()->map(function ($product) {

            $categories = $product->categories()->get()->map(function ($category) {
                return $category->erp_category_id;
            })->toArray();

            $descriptions = $product
            ->descriptions()
            ->get()
            ->map(function ($description) {
                return [
                    'language_id'       => $description->language_id,
                    'name'              => $description->name,
                    'meta_title'        => $description->name,
                    'description'       => $description->description ?? '',
                    'meta_description'  => '',
                    'meta_keyword'      => '',
                ];
            })->toArray();

            return [
                'id'            => $product->erp_product_id,
                'model'         => $product->model,
                'sku'           => $product->sku,
                'mpn'           => $product->mpn,
                'upc'           => '',
                'ean'           => $product->ean,
                'jan'           => '',
                'isbn'          => '',
                'location'      => '',
                'minimum'       => 1,
                'subtract'      => 1,
                'points'        => 0,
                'shipping'      => 1,
                'length'        => 0,
                'width'         => 0,
                'height'        => 0,
                'length_class_id' => 1,
                'sort_order'    => 0,
                'price'         => $product->price_with_vat,
                'quantity'      => $product->quantity,
                'manufacturer_id'=> $product->manufacturer()?->get()?->first()?->erp_manufacturer_id,
                'weight'        => $product->weight,
                'weight_class_id'=> 1,
                'status'        => $product->status,
                'date_added'    => $product->date_added,
                'date_modified' => $product->date_modified,
                'product_category' => $categories,
                'product_store' => $product->created_at,
                'product_description' => $descriptions,
            ];
        });

        return $products;
    }
}
