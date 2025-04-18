<?php
require_once __DIR__ . '/src/WeatherController.php';

$controller = new WeatherController();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
}

?>