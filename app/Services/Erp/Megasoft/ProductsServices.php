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
            'SiteKey' => MegasoftConstants::SITE_KEY,
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
                $validProductDescription = $this->productsRepository->prepareProductDescription(1, $productMegasoft);

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

                    $createdProducts[] = $this->productsRepository->createProductAndDescription(
                        $validProduct,
                        $validProductDescription
                    );
                }
            }
        });

        return [
            'updated' => $updatedProducts,
            'created' => $createdProducts,
        ];
    }
}
