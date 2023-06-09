<?php

namespace App\Console\Commands;

use App\Repositories\CategoriesRepository;
use App\Services\Erp\Megasoft\CategoriesServices as CategoriesMegasoftServices;
use App\Services\Store\Opencart\CategoriesService as CategoriesOpencartServices;
use Illuminate\Console\Command;

class Categories extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:categories';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        
        $endpointCategories = '/GetItemGroups';
        $endpointOpencartCategories = '/prismaCategories';

        $repoCategories = new CategoriesRepository();
        $categoriesMegasoftServices = new CategoriesMegasoftServices($repoCategories);

        $response = $categoriesMegasoftServices
        ->createOrUpdateCategories($endpointCategories);

        $this->info('(Megasoft) Created items: '.count($response['created']));
        $this->info('(Megasoft) Updated items: '.count($response['updated']));

        $categoriesOpencartService = new CategoriesOpencartServices();
        $categories = $categoriesOpencartService->getCategoriesForOpencart();

        $opencartResponse = $categoriesOpencartService
        ->setData(
            $endpointOpencartCategories,
            $categories->toArray()
            );

        $this->info('(Opencart) Created items: '. $opencartResponse['data']['total_insert']); 
        $this->info('(Opencart) Updated items: '. $opencartResponse['data']['total_update']);    
    }
}
