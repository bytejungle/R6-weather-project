<?php

namespace App\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class RemoveReportedCity extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'city:remove {city}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove a reported city. Reported cities are included in daily automatic reporting.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {

            DB::table('reported_cities')
            ->where('city', '=', $this->argument('city'))
            ->delete();

            $this->info($this->argument('city') . ' was removed from the automatic reports!');

        } catch (Exception $exception) {
            $this->error('Something went wrong!');
        }
    }
}
