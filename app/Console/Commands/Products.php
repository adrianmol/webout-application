<?php

namespace App\Console\Commands;

use App\Repositories\ProductsRepository;
use App\Services\Erp\Megasoft\ProductsServices as ProductsMegasoftServices;
use App\Services\Store\Opencart\ProductsService as ProductsOpencartServices; 
use Illuminate\Console\Command;
use Illuminate\Contracts\Console\Isolatable;

class Products extends Command implements Isolatable
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:products {--date=}';

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
        $startTime = microtime(true);
        $endpointProductsMegasoft = '/GetProducts';
        $endpointProductsOpencart = '/prismaProducts';

        $date = $this->option('date') ?? '';

        $this->info($date);
        $productsRepository = new ProductsRepository();
        $productsMegasoftServices = new ProductsMegasoftServices($productsRepository);
        $productsOpencartServices = new ProductsOpencartServices();

        $MegasoftResponse = $productsMegasoftServices->createOrUpdateProducts($endpointProductsMegasoft, $date);
        $endTime = microtime(true);
        $this->info('(Megasoft Execution Time '.$endTime - $startTime.'sec) Updated items: '.count($MegasoftResponse['updated'] ?? 0));
        $this->info('(Megasoft Execution Time '.$endTime - $startTime.'sec) Created items: '.count($MegasoftResponse['created'] ?? 0));
        
        
        $productsOpencart = $productsOpencartServices->getProductsForOpencart($date);
        $opencartResponse = $productsOpencartServices->setData($endpointProductsOpencart,$productsOpencart->toArray());
        
        if(!$opencartResponse->isEmpty()){
            $endTime = microtime(true);
            $this->info('(Opencart Execution Time '.$endTime - $startTime.'sec) Updated items: ' . $opencartResponse['data']['total_update']);
            $this->info('(Opencart Execution Time '.$endTime - $startTime.'sec) Created items: ' . $opencartResponse['data']['total_insert']);
        }
    }
}
