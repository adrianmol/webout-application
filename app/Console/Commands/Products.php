<?php

namespace App\Console\Commands;

use App\Repositories\ProductsRepository;
use App\Services\Erp\Megasoft\ProductsServices;
use Illuminate\Console\Command;

class Products extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:products {date}';

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
        $endpointProducts = '/GetProducts';
        $date = $this->argument('date') ?? '';

        $productsRepository = new ProductsRepository();
        $productsServices = new ProductsServices($productsRepository);

        $response = $productsServices->createOrUpdateProducts($endpointProducts, $date);

        $this->info('Updated items: '.count($response['updated']));
        $this->info('Created items: '.count($response['created']));
    }
}
