# Weather Application

This application uses a 3rd party weather API to display tabulated weather forecasts in an interactive React website, and automatically generate weather reports.

## Table Of Contents

- [Technologies](#technologies)
- [Console Commands](#console-commands)
- [Requirements](#requirements)
- [Setup & Installation](#setup---installation)
- [Job System](#job-system)
- [Assumptions](#assumptions)
- [Design Decisions](#design-decisions)
- [Improvements](#improvements)
- [Demonstration](#demonstration)

## Technologies
* [React](https://react.dev/)
* [Laravel](https://laravel.com/)
* [TailwindCSS](https://tailwindcss.com/)
* [Daisy UI](https://daisyui.com/)

## Console Commands
The following commands can be used in the console to perform actions:

| **COMMAND** | **USAGE** | **DESCRIPTION** |
|---|---|---|
| forecast {cities} | php artisan forecast {cities} | Get weather forcast for the specified city or cities |
| city:add {city} | php artisan city:add {city} | Add a reported city. Reported cities are included in daily automatic reporting. |
| city:remove {city} | php artisan city:remove {city} | Remove a reported city. Reported cities are included in daily automatic reporting. |
| city:list | php artisan city:list | List reported cities. Reported cities are included in daily automatic reporting. |

## Requirements
* Node.JS
* PHP
* Composer

## Setup & Installation
1. Clone the repository onto your machine.
2. Create a MySQL database schema on your machine for the project. Keep the details handy.
3. Sign up to [WeatherBit](https://www.weatherbit.io/api) and get a free tier API key.
4. Complete the following steps within the `/src/` folder of the cloned repository.
5. Copy the contents of `.env.example` to `.env` and configure the database values and add your WeatherBit api key.
6. Install composer packages with `composer install`
7. Install NPM packages using `npm install`
8. Generate the Laravel application key using `php artisan key generate`.
9. Run database migrations using `php artisan migrate:fresh`.
10. Start the development server using `npm run dev`.
11. In another terminal, serve the web application with `php artisan serve`.
12. Access and interact with the website using the url.

## Job System
For daily automated weather forecasts there is a `DailyReportJob` which runs daily. Follow instructions below to get this running.
1. Complete the following steps within the `/src/` folder of the cloned repository.
2. Start the queue worker with `php artisan queue:work`.
3. In another terminal, start the scheduler with `php artisan schedule:work`.

## Assumptions
- Commands are required to specifiy which cities are included in daily reports.
- A daily report is just a `Report` record in the database that has many `DayForecast` records.
- Daily reports do not need to be accessible by end users.

## Design Decisions
- WeatherBit API was chosen as it had been recommended, offers a generous free tier, and has a suitable endpoint for interpretable weather forecasting.
- DaisyUI was chosen as a TailwindCSS component library for the project to save time developing a simple frontend.
- A spinner displays when loading data so the user has knowledge that their request is being served.
- ReactJS was used for the frontend. A limited amount of components were created so the project didn't become unnecessarily complicated.
- A class `WeatherBitApi` was created to interact with the WeatherBit API. This was done so functionality can be expanded in future should the need arise.
- An environment variable `WEATHERBIT_API_KEY` was added to the `.env` file, because it's a good idea to keep keys out of version control ;).

## Improvements
- Add improved error handling.
- Add response body to unsuccessful API requests.
- Support city names that contain a space in the console commands i.e. "Gold Coast"
- Add check to see if city is actually a city, instead of regex.

## Demonstration

### Website
![Website](https://i.gyazo.com/ed8b954e77860ee5dd5971f25d3f0b33.gif)

### Forecast Table
![Forecast](https://imgur.com/G2py1Mg.png)

### Bad Input
![Bad Input](https://imgur.com/Hjiccyj.png)

### Add City
![Add City](https://imgur.com/q1BVOqj.png)

### List Cities
![Cities](https://imgur.com/JkesW0h.png)