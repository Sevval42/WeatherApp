<?php
require_once __DIR__ . '/src/WeatherController.php';
require 'src/Router.php';

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);



$controller = new WeatherController();

$router = new Router;
$router->add('/index', Closure::fromCallable([$controller, 'showForm']));
$router->add('/search/{city}', fn ($city) => $controller->searchCities($city));
$router->add('/weather/{city}/{lat}/{long}', fn($searchName, $lat, $long) => $controller->getWeatherForCity($searchName, (float)$lat, (float)$long));
$router->detach($path);

/*if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['cityinput'])) {
        $controller->searchCities($_POST['cityinput']);
    } else if (isset($_POST['city'])) {
        $city = json_decode($_POST['city'], true);
        
        $kind = $city['info'] ?? 'weather';
        switch($kind) {
            case 'weather': $controller->getWeatherForCity($_POST['city']); break;
            case 'air': $controller->getAirQualityForCity($_POST['city']); break;
            default: break;
        }
    }
} else {
    $controller->showForm();
}*/

?>