<?php
require_once 'WeatherService.php';
class WeatherController {


    function showForm() 
    {
        require __DIR__ . '/Views/weather.php';
    }

    function searchCities(string $cityName)
    {
        $cityList = WeatherService::getCityCoordinates($cityName);
        require __DIR__ . '/Views/weather.php';
    }

    function getWeatherForCity(string $cityName, float $lat, float $long)
    {
        $cityList = WeatherService::getCityCoordinates($cityName);
        
        $result = WeatherService::getWeatherForCoordinates($lat, $long);
        $result_json = json_decode($result, true);
        $timeArray = array_map(fn($time)=>(new DateTime($time))->format('G') . ':00', $result_json['hourly']['time']);
        $tempArray = $result_json['hourly']['temperature_2m'];
        
        $weather['weather'] = array_combine($timeArray, $tempArray);
        
        require __DIR__ . '/Views/weather.php';
    }

    function getAirQualityForCity(string $cityInput)
    {
        $city = json_decode($cityInput, true);
        $result = WeatherService::getAirQualityForCoordinates($city);
        $result_json = json_decode($result, true);

        $times = array_map(fn($time)=>(new DateTime($time))->format('D d.'), $result_json['hourly']['time']);

        $pollen = $result_json['hourly'];

        $air = [];
        for($i=0; $i<count($times); ++$i) {
            foreach ($pollen as $kind => $values) {
                if($kind == 'time') continue;
                if(!isset($air[$times[$i]][$kind])){
                    $air[$times[$i]][$kind] = $values[$i];
                    continue;
                }
                $air[$times[$i]][$kind] += $values[$i];
            }
        }
        foreach ($air as $key => $value) {
            foreach ($value as $kind => $count) {
                $air[$key][$kind] /= count($times);
                $air[$key][$kind] = round($air[$key][$kind], 2);
            }
        }
        $air = array_merge(['air' => $air], ['info' => $city]);

        if (isset($city['cityList'])) {
            $cityList = $city['cityList'];
        }

        require __DIR__ . '/Views/weather.php';
    }
}
?>