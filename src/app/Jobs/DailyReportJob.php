<?php

namespace App\Jobs;

use App\Models\Report;
use App\Models\ReportedCity;
use App\Networking\WeatherBitApi;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class DailyReportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The amount of days to forecast for.
     *
     * @var string
     */
    protected $days = 5;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        // get the cities that have automatic reporting
        $reportedCities = ReportedCity::all();

        foreach($reportedCities as $reportedCity) {

            $cityName = $reportedCity->city;

            $forecast = WeatherBitApi::getDailyForecast($cityName, $this->days);

                // create new report
                $report = new Report([
                    'city' => $cityName
                ]);

                $report->save();

                foreach ($forecast as $dayForecast) {
                    $dayForecast->report_id = $report->id;
                    $dayForecast->save();
                }
        }
    }
}
