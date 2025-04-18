<?php
session_start();
require_once __DIR__ . '/src/WeatherController.php';

$controller = new WeatherController();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['cityinput'])) {
        $controller->searchCities($_POST['cityinput']);
    } else if (isset($_POST['city'])) {
        $controller->getWeatherForCity($_POST['city']);
    }
} else {
    $controller->showForm();
}

?>