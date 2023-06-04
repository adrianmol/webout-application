<?php

namespace App\Interfaces;

use Illuminate\Support\Collection;

interface CategoriesRepositoryInterface
{
    public function getAllCategories();

    public function getCategoryByErpCategoryId(int $categoryId);

    public function createCategory(array $categoriesDetails);

    public function updateCategory(int $categoryId, Collection $categoriesDetails);
}
