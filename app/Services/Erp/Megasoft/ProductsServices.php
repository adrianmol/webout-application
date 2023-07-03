<?php

namespace App\Services\Erp\Megasoft;

use App\Constants\Erp\Megasoft\MegasoftConstants;
use App\Repositories\ProductsRepository;

class ProductsServices extends MegasoftAbstract
{
    private ProductsRepository $productsRepository;

    public function __construct(
        ProductsRepository $productsRepository
    ) {
        $this->productsRepository = $productsRepository;
    }

    public function createOrUpdateProducts(string $endpoint, string $date = null): ?array
    {
        $date = $date ?: date('m-d-Y H:m', strtotime('-4 hours'));
        $paramForm = [];
        $createdProducts = [];
        $updatedProducts = [];

        $paramForm = [
            'SiteKey' => MegasoftConstants::getMegasoftSiteKey(),
            'StorageCode' => '000',
            'Date' => $date,
        ];

        $productsMegasoft = $this->getData($endpoint, $paramForm, 'StoreDetails');

        if (! $productsMegasoft->count()) {
            return [
                'updated' => $updatedProducts,
                'created' => $createdProducts,
            ];
        }

        $productsMegasoft->each(function ($productMegasoft) use (
            &$updatedProducts,
            &$createdProducts
        ) {
            if (empty($productMegasoft['ItemIdMaster'])) {

                $validProduct = $this->productsRepository->prepareProduct($productMegasoft);
                $validProductDescription = $this->productsRepository->prepareProductDescription(2, $productMegasoft);

                if (
                    $this->productsRepository
                        ->getProductByErpProductId($validProduct->get('erp_product_id'))
                ) {
                    $updatedProducts[] = $this->productsRepository->updateProductAndDescription(
                        $validProduct->get('erp_product_id'),
                        $validProduct,
                        $validProductDescription
                    );
                } else {

                    $product = $this->productsRepository->createProductAndDescription(
                        $validProduct,
                        $validProductDescription
                    );

                    $createdProductImages = $this->productsRepository->createProductImages($product['id'], $product);

                    $createdProducts[] = $product;

                }
            }
        });

        return [
            'updated' => $updatedProducts,
            'created' => $createdProducts,
        ];
    }

    public function getProductImagesInformation(string $endpoint, string $date = null): ?array
    {
        $date = $date ?: date('m-d-Y H:m', strtotime('-4 hours'));
        $paramForm = [];
        $createdProducts = [];
        $updatedProducts = [];

        $paramForm = [
            'SiteKey' => MegasoftConstants::getMegasoftSiteKey(),
            'StorageCode' => '000',
            'Date' => $date,
        ];

        $productImagesMegasoft = $this->getData($endpoint, $paramForm, 'ItemsPhotoInfo');

        $productImagesMegasoft->each(function ($productMegasoft) use (
            &$updatedProducts,
            &$createdProducts
        ) {
            $productId = $this->productsRepository->getProductModel($productMegasoft['ItemCode']);

            if (isset($productId) && ! empty($productId)) {

                $validProductImagesInfo = $this->productsRepository
                    ->prepareProductImagesInfo(
                        $productId?->erp_product_id,
                        $productMegasoft
                    );

                if (
                    $this->productsRepository
                        ->checkUpdatedProductImages($validProductImagesInfo->toArray())
                ) {

                    $updated = $this->productsRepository->updateProductImages($validProductImagesInfo->get('model'), $validProductImagesInfo->toArray());
                    $updatedProducts[] = $validProductImagesInfo->toArray();
                }
            }
        });

        return [
            'updated' => $updatedProducts,
            'created' => $createdProducts,
        ];
    }

    public function downloadProductImages(string $endpoint): ?array
    {
        $paramForm = [];
        $createdProducts = [];
        $updatedProducts = [];
        $megasoftImages['items'] = [];
        $models = [];

        $data = $this->productsRepository->getProductImagesForDownload();

        $data->each(function ($image) use (&$megasoftImages, &$models) {
            $models[] = $image->model;
            $megasoftImages['items'][]['storecode'] = $image->model;
        });

        if ($data->isEmpty()) {
            return [
                'updated' => $updatedProducts,
                'created' => $createdProducts,
            ];
        }

        $paramForm = [
            'SiteKey' => MegasoftConstants::getMegasoftSiteKey(),
            'JsonStrWeb' => json_encode($megasoftImages, JSON_UNESCAPED_SLASHES),
        ];

        $productImagesMegasoft = $this->getData($endpoint, $paramForm, 'ItemImageUpload');

        if (! $productImagesMegasoft->isEmpty()) {
            $updatedProducts = $models;
            $data = $this->productsRepository->updateProductImagesThatHasDownloaded($models);
        }

        return [
            'updated' => $updatedProducts,
            'created' => $createdProducts,
        ];
    }
}
