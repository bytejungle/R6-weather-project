<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\DayForecastResource;
use App\Networking\WeatherBitApi;
use Illuminate\Http\Request;
use Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Validator;

class WeatherController extends Controller
{
    function getWeatherForecast($city)
    {

        // validate city input
        if (!self::areCitiesValid([$city])) {
            return Response::make(null, 400);;
        }

        // get daily weather forecast
        $dailyForecast = WeatherBitApi::getDailyForecast($city, 5);

        // return resource
        return new DayForecastResource($dailyForecast);
    }

    // returns if the provided cities are valid
    static function areCitiesValid($cities) {
        $validator = Validator::make([
            'cities' => $cities
        ],
        [
            'cities' => ['required'],
            'cities.*' => ['regex:/^[a-z A-Z]+$/']
        ]);

        return $validator->passes();
    }
}
