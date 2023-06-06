<?php

    namespace App\Networking;
    use App\Models\DayForecast;
    use Carbon\Carbon;
    use Http;

    class WeatherBitApi {

        public static function getDailyForecast($city, $days)
        {
            // get key from .env file
            $apiKey = env('WEATHERBIT_API_KEY');

            // daily forecast api endpoint
            $endpoint = 'https://api.weatherbit.io/v2.0/forecast/daily';

            // the request url
            $url = "{$endpoint}?key={$apiKey}&city={$city}&days={$days}";

            // make api request
            $apiResponse = Http::get($url);
            if ($apiResponse->ok()) {

                // decode the request body
                $apiResponseBody = json_decode($apiResponse->body(), true);

                $daysForecasted = [];

                // loop over days forecasted in response
                foreach($apiResponseBody['data'] as $dayForecast) {

                    $daysForecasted[] = new DayForecast([
                        'date' => $dayForecast['valid_date'],
                        'maximum_temperature' => $dayForecast['high_temp'],
                        'minimum_temperature' => $dayForecast['low_temp'],
                        'average_temperature' => $dayForecast['temp']
                    ]);
                }

                return $daysForecasted;
            }
        }
    }
