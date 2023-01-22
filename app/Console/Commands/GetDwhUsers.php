<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Log;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;


class GetDwhUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Get:DWH';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'get DWH users';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
       $response =  Http::post('https://prod-102.westeurope.logic.azure.com:443/workflows/7df75441a2864990af2f65bad154c074/triggers/manual/paths/invoke?api-version=2016-10-01&sp=%252Ftriggers%252Fmanual%252Frun&sv=1.0&sig=PPhPIPl2HapzWCQa0mZUNmu0ytTOlDRmR_EzlHInoWw',
                [
            "AuthToken" => "Q2cafLorUD",
            "FromDate_yyyy-mm-dd" => "2012",
            "ToDate_yyyy-mm-dd" => "2023-12-05",
            "ViewName" => "vw_dimCustomers_Prod",
            "HasSFcode" => 1,
            "SITE_USE_CODE" => 1
        ]);
        
       
        Log::channel("daily")->info($response);
    }
}
