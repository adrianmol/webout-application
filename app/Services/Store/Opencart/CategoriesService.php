<?php

namespace App\Services\Store\Opencart;

use App\Models\Category;

class CategoriesService extends OpencartAbstractService
{
    public function getCategoriesForOpencart()
    {

        $categories = Category::All()->map(function ($category) {

            $descriptions = $category
                ->descriptions()
                ->get()
                ->map(function ($description) {
                    return [
                        'language_id' => $description->language_id,
                        'name' => $description->name,
                        'meta_title' => $description->name,
                        'description' => $description->description ?? '',
                        'meta_description' => '',
                        'meta_keyword' => '',
                    ];
                });

            return [
                'category_id' => $category->erp_category_id,
                'parent_id' => $category->parent_id,
                'category_code' => '',
                'status' => $category->status,
                'sort_order' => $category->sort_order,
                'category_store' => 0,
                'date_modified' => $category->updated_at,
                'date_added' => $category->created_at,
                'category_description' => $descriptions->toArray(),
            ];
        });

        return $categories;
    }
}
