<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\DayForecastResource;
use App\Networking\WeatherBitApi;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    function getWeatherForecast($city)
    {

        // get daily weather forecast
        $dailyForecast = WeatherBitApi::getDailyForecast($city, 5);

        // return resource
        return new DayForecastResource($dailyForecast);
    }
}
