<?php

namespace App\Services\Erp\Megasoft;

use App\Constants\Erp\Megasoft\MegasoftConstants;
use App\Repositories\CategoriesRepository;

class CategoriesServices extends MegasoftAbstract
{
    private CategoriesRepository $categoryRepository;

    public function __construct(
        CategoriesRepository $categoryRepository
    ) {
        $this->categoryRepository = $categoryRepository;
    }

    public function createOrUpdateCategories(string $endpoint): ?array
    {
        $paramForm = [];
        $createdCategories = [];
        $updatedCategories = [];

        $paramForm = [
            'SiteKey' => MegasoftConstants::getMegasoftSiteKey(),
        ];

        $categoriesMegasoft = $this->getData($endpoint, $paramForm, 'GroupsListItems');

        if (! $categoriesMegasoft->count()) {
            return [
                'updated' => $updatedCategories,
                'created' => $createdCategories,
            ];
        }

        $categoriesMegasoft->each(function ($categoryMegasoft) use (
            &$updatedCategories,
            &$createdCategories
        ) {
            if ($categoryMegasoft['eShop']) {

                $validCategory = $this->categoryRepository->prepareCategory($categoryMegasoft);
                $validCategoryDescription = $this->categoryRepository->prepareCategoryDescription($categoryMegasoft);

                if (
                    $this->categoryRepository
                        ->getCategoryByErpCategoryId($validCategory->get('erp_category_id'))
                ) {
                    $updatedCategories[] = $this->categoryRepository->updateCategoryAndDescription(
                        $validCategory->get('erp_category_id'),
                        $validCategory,
                        $validCategoryDescription
                    );
                } else {

                    $createdCategories[] = $this->categoryRepository->createCategoryAndDescription(
                        $validCategory,
                        $validCategoryDescription
                    );
                }
            }
        });

        return [
            'updated' => $updatedCategories,
            'created' => $createdCategories,
        ];
    }
}
