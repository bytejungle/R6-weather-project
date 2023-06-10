<?php

namespace App\Console\Commands;

use App\Models\ReportedCity;
use Exception;
use Illuminate\Console\Command;

class ListReportedCity extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'city:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List reported cities. Reported cities are included in daily automatic reporting.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {

            $reportedCities = ReportedCity::all();

            $this->line('List of cities included in automatic report generation:');
            foreach ($reportedCities as $reportedCity) {
                $this->line($reportedCity->city);
            }

        } catch (Exception $exception) {
            $this->error('Something went wrong!');
        }
    }
}
