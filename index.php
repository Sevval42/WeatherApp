<?php
require_once __DIR__ . '/src/WeatherController.php';
require_once __DIR__ . '/src/Router.php';

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);



$controller = new WeatherController();

$router = new Router;
$router->add('/', Closure::fromCallable([$controller, 'showForm']));

$router->add(
    '/search/{city}',
    fn ($city) => $controller->searchCities($city)
);

$router->add(
    '/weather/{city}/{country}/{lat}/{long}',
    fn($searchName, $country, $lat, $long) 
        => $controller->getWeatherForCity($searchName, $country, (float)$lat, (float)$long)
);

$router->add(
    '/air/{city}/{country}/{lat}/{long}',
    fn($searchName, $country, $lat, $long)
        => $controller->getAirQualityForCity($searchName, $country, (float)$lat, (float)$long)
);

$router->detach($path);

?>