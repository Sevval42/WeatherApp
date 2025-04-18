<?php
class WeatherService {

    public static function getCityCoordinates(string $city): array
    {
        $city = urlencode($city);
        $url = "https://geocoding-api.open-meteo.com/v1/search?name=$city";
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

    public static function getWeatherForCoordinates(array $coords)
    {
        $url = "https://api.open-meteo.com/v1/forecast?";
        $parameters = [
            'latitude'      => (string)$coords['lat'],
            'longitude'     => (string)$coords['long'],
            'hourly'        => "temperature_2m",
            'forecast_days' => '1'
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