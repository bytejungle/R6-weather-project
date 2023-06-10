<?php

namespace App\Console\Commands;

use App\Http\Controllers\WeatherController;
use App\Networking\WeatherBitApi;
use Carbon\Carbon;
use Exception;
use Illuminate\Console\Command;
use Str;

class forecast extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:forecast {cities?*}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get weather forcast for the specified city';

    /**
     * The amount of days to forecast for.
     *
     * @var string
     */
    protected $days = 5;

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $cityNames = $this->argument('cities');

        $commandOutputData = [];

        // if no city name was specified then prompt the user
        if (!$cityNames) {
            $cityName = $this->ask('Please enter a city name:');
            $cityNames = [$cityName];
        }

        // validate city data
        if (!WeatherController::areCitiesValid($cityNames)) {
            return $this->error('You provided an invalid city name!');
        }

        foreach ($cityNames as $cityName) {

            try {
                $forecast = WeatherBitApi::getDailyForecast($cityName, $this->days);

                $cityOutputRow = [$cityName];

                // forecast format with placeholders
                $forecastFormat = 'Avg: ?, Max: ?, Low: ?';

                foreach ($forecast as $dayForecast) {
                    // replace placeholders in forecast format
                    $cityOutputRow[] = Str::replaceArray('?', [
                        $dayForecast->average_temperature,
                        $dayForecast->maximum_temperature,
                        $dayForecast->minimum_temperature
                    ], $forecastFormat);
                }

                $commandOutputData[] = $cityOutputRow;
            } catch (Exception $exception) {
                $this->error('Something went wrong whilst retrieving weather data for:' . $cityName);
            }
        }

        // check if output data is available
        if (!empty($commandOutputData)) {
            // table headers
            $commandOutputHeaders = ['City'];
            for ($i = 0; $i < $this->days; $i++) {
                $dateString = Carbon::now()->addDays($i)->format('d/m/Y');
                $commandOutputHeaders[] = $dateString;
            }

            // output data in table format
            $this->table($commandOutputHeaders, $commandOutputData);
        }
    }
}
