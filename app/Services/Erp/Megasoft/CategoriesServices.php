<?php 

namespace App\Services\Erp\Megasoft;

use Illuminate\Support\Facades\Http;
use App\Constants\Erp\Megasoft\MegasoftConstants;
use App\Models\Category;
use App\Models\CategoryDescription;

class CategoriesServices
{
    public function getCategories(string $endpoint, string $date = ''): ?array
    {
        $paramForm           = array();
        $prepareCategories   = array();
        $prepareCategoryDescription = array();

        $paramForm = [
            'SiteKey' =>MegasoftConstants::SITE_KEY 
        ];

        $response = Http::asForm()
        ->post(
            MegasoftConstants::URL . $endpoint,
            $paramForm
        );
        
        if(!$response->ok()){
            return [];
        }

        $categories = collect(json_decode(json_encode((array)simplexml_load_string($response->body())),true)['GroupsListItems']);

        if(empty($categories)){
            return [];
        }

        $categories->each(function($categories) use (&$prepareCategories, &$prepareCategoryDescription, &$insertOrUpdateCategory){

            if($categories['eShop']){

                $cat = new Category();
                $prepareCategories[] = $cat;
                
                $cat->erp_id = $categories['Id'];
                $cat->parent_id = !empty($categories['GroupId']) ? $categories['GroupId'] : 0;
                $cat->status = isset($categories['Disable']) && $categories['Disable'] == 'False' ? 0 : 1;
                $cat->sort_order = $categories['Sort'];

                $cat->save();
                $categoryDescription = new CategoryDescription();

                $categoryDescription->language_id  = 1;
                $categoryDescription->name         = $categories['Description'];
                $categoryDescription->code         = $categories['Code'];

                
                $cat->description()
                ->save($categoryDescription);

            }
        });

        
        
        //CategoryDescription::upsert($prepareCategories,['erp_id']);

        return $prepareCategories;
    }
}