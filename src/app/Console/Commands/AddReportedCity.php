<?php

namespace App\Console\Commands;

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
        try {

            ReportedCity::firstOrCreate([
                'city' => $this->argument('city')
            ]);

            $this->info($this->argument('city') . ' was added to the automatic reports!');

        } catch (Exception $exception) {
            $this->error('Something went wrong!');
        }
    }
}
