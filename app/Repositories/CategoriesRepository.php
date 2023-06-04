<?php

namespace App\Repositories;

use App\Interfaces\CategoriesRepositoryInterface;
use App\Models\Category;
use App\Utils\Util;
use Illuminate\Support\Collection;

class CategoriesRepository implements CategoriesRepositoryInterface
{
    public function getAllCategories()
    {

    }

    public function getCategoryByErpCategoryId(int $categoryId): ?Category
    {
        return Category::where(['erp_category_id' => $categoryId])->first();
    }

    public function createCategory(array $categoriesDetails)
    {

    }

    public function updateCategory(int $categoryId, Collection $categoriesDetails)
    {

    }

    public function createCategoryAndDescription(
        Collection $categoriesDetails,
        Collection $categoriesDescriptionDetails
    ): array {

        $categoryModel = Category::create($categoriesDetails->filter()->toArray());
        $categoryModel->descriptions()->create($categoriesDescriptionDetails->filter()->toArray());

        return $categoryModel->toArray();
    }

    public function updateCategoryAndDescription(
        int $categoryId,
        Collection $categoriesDetails,
        Collection $categoriesDescriptionDetails
    ): array {

        $categoryModel = Category::where(['erp_category_id' => $categoryId])->first();

        $categoryModel->update($categoriesDetails->filter()->toArray());
        $categoryModel->descriptions()->update($categoriesDescriptionDetails->filter()->toArray());

        return $categoryModel->toArray();
    }

    public function prepareCategory(array $categoriesDetails): Collection
    {
        return collect([
            'erp_category_id' => Util::isEmpty($categoriesDetails['Id']),
            'parent_id' => Util::isEmpty($categoriesDetails['GroupId']),
            'status' => Util::isEnable($categoriesDetails['Disable']),
            'sort_order' => Util::isEmpty($categoriesDetails['Sort']),
        ]);
    }

    public function prepareCategoryDescription(array $categoriesDetails): Collection
    {
        return collect([
            'language_id' => 1,
            'name' => Util::isEmpty($categoriesDetails['Description']),
            'code' => Util::isEmpty($categoriesDetails['Code']),
        ]);
    }
}
