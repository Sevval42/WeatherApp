<?php
class WeatherService {

    private const CITY_URL = "https://geocoding-api.open-meteo.com/v1/search?name=";
    private const WEATHER_URL = "https://api.open-meteo.com/v1/forecast?";
    private const AIR_URL = "https://air-quality-api.open-meteo.com/v1/air-quality?";

    private const POLLEN = [
        'alder_pollen',
        'birch_pollen',
        'grass_pollen',
        'mugwort_pollen',
        'olive_pollen',
        'ragweed_pollen',
    ];

    public static function getCityCoordinates(string $city): array
    {
        $url = self::CITY_URL . "$city";
        $result = file_get_contents($url);
        $json = json_decode($result, true)['results'];
        $result = [];
        foreach($json as $entry) {
            $result[] = [
                'name' => $entry['name'],
                'country_code' => $entry['country_code'],
                'lat' => $entry['latitude'],
                'long' => $entry['longitude'],
            ];
        }
        return $result;
    }

    public static function getWeatherForCoordinates(float $lat, float $long)
    {
        $url = self::WEATHER_URL;
        $parameters = [
            'latitude'      => (string)$lat,
            'longitude'     => (string)$long,
            'hourly'        => "temperature_2m",
            'forecast_days' => '1',
            'timezone'      => 'Europe%2FBerlin',
        ];
        
        foreach($parameters as $key => $value){
            $url = $url . "{$key}={$value}&";
        }
        $url = substr($url, 0, -1);
        $result = file_get_contents($url);
        return $result;
    }

    public static function getAirQualityForCoordinates(float $lat, float $long)
    {
        $url = self::AIR_URL;
        $parameters = [
            'latitude'      => (string)$lat,
            'longitude'     => (string)$long,
            'hourly'        => implode(',', self::POLLEN),
            'forecast_days' => '4',
            'timezone'      => 'Europe%2FBerlin',
        ];
        
        foreach($parameters as $key => $value){
            $url = $url . "{$key}={$value}&";
        }
        $url = substr($url, 0, -1);
        $result = file_get_contents($url);
        return $result;
    }
    
}
?>