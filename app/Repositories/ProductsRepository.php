<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImages;
use App\Utils\Util;
use Illuminate\Support\Collection;

class ProductsRepository
{
    public function getAllProducts()
    {

    }

    public function getProductByErpProductId(int $productId)
    {
        return Product::where(['erp_product_id' => $productId])->first();
    }

    public function getProductModel(string $model)
    {
        return Product::where(['model' => $model])->get()->first();
    }

    public function checkUpdatedProductImages(array $productInfo)
    {
        return ProductImages::where('model', $productInfo['model'])
            ->where('last_updated', '<', $productInfo['last_updated'])
            ?->get()
            ?->first();
    }

    public function createProduct(array $productsDetails)
    {

    }

    public function updateProduct(int $productId, Collection $productsDetails)
    {

    }

    public function createProductAndDescription(
        Collection $productsDetails,
        Collection $productsDescriptionDetails
    ) {

        $productModel = Product::create($productsDetails->filter()->toArray());
        $categoryId = Category::where(['erp_category_id' => $productsDetails->get('category_id')])->pluck('id')->first();

        $productModel->descriptions()->create($productsDescriptionDetails->filter()->toArray());
        $productModel->categories()->attach($categoryId);

        return $productModel->toArray();
    }

    public function updateProductAndDescription(
        int $productId,
        Collection $productsDetails,
        Collection $productsDescriptionDetails
    ) {

        $productModel = $this->getProductByErpProductId($productId);
        $categoryId = Category::where(['erp_category_id' => $productsDetails->get('category_id')])->pluck('id')->first();

        $productModel->update($productsDetails->filter()->toArray());
        $productModel->descriptions()->update($productsDescriptionDetails->filter()->toArray());
        $productModel->categories()->sync($categoryId);

        return $productModel->toArray();
    }

    public function createProductImages(int $productId, array $productDetails)
    {

        $attributes = [
            'product_id' => $productId,
            'model' => $productDetails['model'],
            'last_updated' => '2020-01-01 00:00:00',
        ];

        return ProductImages::updateOrCreate($attributes, ['product_id' => $productId]);
    }

    public function updateProductImages(string $model, array $productDetails)
    {

        $attributes = [
            'downloaded' => 0,
            'last_updated' => (string) $productDetails['last_updated'],
        ];

        return ProductImages::where('model', $model)->update($attributes);
    }

    public function getProductImagesForDownload()
    {
        return ProductImages::where('downloaded', 0)?->limit(20)?->get();
    }

    public function updateProductImagesThatHasDownloaded(array $models)
    {
        return ProductImages::whereIn('model', $models)->update(['downloaded' => 1]);
    }

    public function prepareProduct(array $productsDetails)
    {

        return collect([
            'erp_product_id' => Util::isEmpty($productsDetails['ItemId']),
            'model' => Util::isEmpty($productsDetails['ItemCode']),
            'sku' => Util::isEmpty($productsDetails['ItemBarcode']),
            'ean' => Util::isEmpty($productsDetails['ItemAuxCode']),
            'quantity' => Util::isEmpty($productsDetails['ItemStock']),
            'manufacturer_id' => Util::isEmpty($productsDetails['ItemManufacturerId']),
            'category_id' => Util::isEmpty($productsDetails['ItemGroupId']),
            'price' => Util::isEmpty($productsDetails['ItemRetail']),
            'price_with_vat' => Util::isEmpty($productsDetails['ItemRetailVat']),
            'wholesale_price' => Util::isEmpty($productsDetails['ItemWholesale']),
            'weight' => Util::isEmpty($productsDetails['ItemWeight']),
            'status' => 1,
            'created_at' => \DateTime::createFromFormat('m/d/Y  H:i:s A', $productsDetails['ItemDateCreated'])->format('Y-m-d H:m:s'),
            'updated_at' => \DateTime::createFromFormat('m/d/Y  H:i:s A', $productsDetails['ItemDateModified'])->format('Y-m-d H:m:s'),
        ]);
    }

    public function prepareProductDescription(int $languageId, array $productsDetails)
    {
        return collect([
            'language_id' => $languageId,
            'name' => Util::isEmpty($productsDetails['ItemDescr']),
            'description' => Util::isEmpty($productsDetails['ItemNotes']),
        ]);
    }

    public function prepareProductImagesInfo(int $productId, array $productsDetails)
    {
        return collect([
            'product_id' => $productId,
            'model' => Util::isEmpty($productsDetails['ItemCode']),
            'last_updated' => \DateTime::createFromFormat('m/d/Y  H:i:s A', $productsDetails['ItemPhotoDate'])->format('Y-m-d H:m:s'),
        ]);
    }
}
