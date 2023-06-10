<?php

namespace App\Console\Commands;

use App\Http\Controllers\WeatherController;
use App\Models\ReportedCity;
use Exception;
use Illuminate\Console\Command;

class AddReportedCity extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'city:add {city}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add a reported city. Reported cities are included in daily automatic reporting.';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $cityName = $this->argument('city');

        try {

            // validate city data
            if (!WeatherController::areCitiesValid([$cityName])) {
                return $this->error('You provided an invalid city name!');
            }

            ReportedCity::firstOrCreate([
                'city' => $cityName
            ]);

            $this->info($cityName . ' was added to the automatic reports!');

        } catch (Exception $exception) {
            $this->error('Something went wrong!');
        }
    }
}
