<?php
require_once 'WeatherService.php';
class WeatherController {


    function showForm() 
    {
        require __DIR__ . '/Views/weather.php';
    }

    function searchCities(string $cityInput)
    {
        $cityList = WeatherService::getCityCoordinates($cityInput);
        require __DIR__ . '/Views/weather.php';
    }

    function getWeatherForCity(string $cityInput)
    {
        $city = json_decode($cityInput, true);
        $result = WeatherService::getWeatherForCoordinates($city);
        $result_json = json_decode($result, true);
        $timeArray = array_map(fn($time)=>(new DateTime($time))->format('G') . ':00', $result_json['hourly']['time']);
        $tempArray = $result_json['hourly']['temperature_2m'];
        
        $weather['weather'] = array_combine($timeArray, $tempArray);
        $weather['info'] = $city;

        if (isset($city['cityList'])) {
            $cityList = $city['cityList'];
        }
        
        require __DIR__ . '/Views/weather.php';
    }
}
?>