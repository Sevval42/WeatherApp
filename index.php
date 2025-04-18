<?php 
require_once 'weatherapi.php';
require_once 'display.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Weather brrr</h2>
    <form action="index.php" method="POST">
        Stadt: <input type="text" name="cityinput">
        <input type="submit">
    </form>
    <form action="index.php" method="POST">
        <?php
            if(isset($_POST['cityinput'])){
                $foundCities = getCityCoordinates($_POST['cityinput']);
                $_SESSION['cities'] = $foundCities;
            }
            if(isset($_SESSION['cities'])){
                foreach ($_SESSION['cities'] as $city) {
                    $text = "{$city['name']}, {$city['country_code']} ({$city['lat']}, {$city['long']})";
                    $cityinfo = json_encode($city);
                    echo "<button type='submit' name='city' class='city-button' value='$cityinfo'>$text</button>";
                }
            }
        ?>
    </form>
</body>
</html>

<?php
    if(isset($_POST["city"])){
        $city = json_decode($_POST['city'], true);
        $result = getWeatherForCoordinates($city);
        $result_json = json_decode($result, true);
        
        $timeArray = array_map(fn($time)=>(new DateTime($time))->format('G') . ':00', $result_json['hourly']['time']);
        $tempArray = $result_json['hourly']['temperature_2m'];
        
        $weather['weather'] = array_combine($timeArray, $tempArray);
        $weather['info'] = $city;
        displayWeather($weather);
    }

    
?>