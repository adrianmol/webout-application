<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\Erp\Megasoft\ManufacturersServices;

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
        
        $manufacturersServices = new ManufacturersServices();
        $response = $manufacturersServices->getManufacturers($endpointManufacturers);
        echo ( 'Updated items: ' . count($response));
    }
}