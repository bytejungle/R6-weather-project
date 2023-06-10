import axios from "axios";

export async function getWeatherForecast(city) {
    return await axios.get(`/api/weather/forecast/${city}`);
}
