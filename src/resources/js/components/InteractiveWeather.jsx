import React, { useState } from "react";
import ForecastTable from "./ForecastTable";
import { getWeatherForecast } from "../networking/api";
import LoadingSpinner from "./LoadingSpinner";

// list of cities available to user
const availableCities = ["Brisbane", "Gold Coast", "Sunshine Coast"];

const CitySelect = () => {
    // the selected city
    const [selectedCity, setSelectedCity] = useState("Please select a city");

    // the daily forecast data returned by the api
    const [dailyForecast, setDailyForecast] = useState([]);

    // if api response is loading
    const [isLoading, setIsLoading] = useState(false);

    // if the forecast table should be displayed to the user
    const shouldDisplayTable = dailyForecast.length > 0 && !isLoading;

    // handle city select
    const onCitySelect = (city) => {
        setSelectedCity(city);

        // get the weather forecast
        setIsLoading(true);

        getWeatherForecast(city)
            .then((response) => {
                // check if response is valid
                if (response.status === 200) {
                    setDailyForecast(response.data.data);
                }
            })
            .finally(() => setIsLoading(false));
    };

    return (
        <React.Fragment>
            <div className="form-control w-full max-w-xs">
                <label className="label">
                    <span className="label-text">Select</span>
                </label>
                <select
                    className="select select-bordered"
                    onChange={(event) => onCitySelect(event.target.value)}
                    value={selectedCity}
                >
                    <option disabled>
                        Please select a city
                    </option>
                    {availableCities.map((availableCity, index) => {
                        return <option key={index}>{availableCity}</option>;
                    })}
                </select>
            </div>
            {/* data display */}
            <div className="mt-4">
                {isLoading && <LoadingSpinner />}
                {shouldDisplayTable && (
                    <ForecastTable dailyForecast={dailyForecast} />
                )}
            </div>
        </React.Fragment>
    );
};

export default CitySelect;
