<?php

namespace App\Console\Commands;

use App\Services\Erp\Megasoft\ManufacturersServices;
use App\Services\Store\Opencart\ManufacturersService as StoreManufacturersService;
use Illuminate\Console\Command;

class Manufacturers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:manufacturers';

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
        $endpointManufacturers = '/GetManufacturers';
        $storeEndpointManufacturers = '/prismaManufacturers';

        $manufacturersServices = new ManufacturersServices();
        $storeManufacturersService = new StoreManufacturersService();

        $response = $manufacturersServices->getManufacturers($endpointManufacturers);

        $this->info('(Prisma) Created items: '.count($response));
        
        $storeManufacturers = $storeManufacturersService->getManufacturersForOpencart();
        $opencartResponse = $storeManufacturersService->setData($storeEndpointManufacturers, $storeManufacturers->toArray());
        
        if(! $opencartResponse->isEmpty()){

            $this->info('(Opencart) Created items: '.$opencartResponse['data']['total_insert']);
            $this->info('(Opencart) Updated items: '.$opencartResponse['data']['total_update']);
        }    
    }
}
