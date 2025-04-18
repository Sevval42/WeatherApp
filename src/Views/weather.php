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
            if(isset($cityList)){
                foreach ($cityList as $city) {
                    $text = "{$city['name']}, {$city['country_code']} ({$city['lat']}, {$city['long']})";
                    $city['cityList'] = $cityList;
                    $cityInfo = json_encode($city);
                    
                    echo "<button type='submit' name='city' class='city-button' value='$cityInfo'>$text</button>";
                }
            }
        ?>
    </form>
    <?php 
        if (isset($weather)) {
            $info = $weather['info'];
            $weather = $weather['weather'];
            echo "<div class='weather-container'>";
            echo "<div class='weather-header'>";
            echo "<div class='weather-title'>Das Wetter in {$info['name']}, {$info['country_code']}</div>";
            echo "<p class='weather-coordinates'>({$info['lat']}, {$info['long']})</p>";
            echo "</div>";
            echo "<div class='weather-scroll'>";
            foreach ($weather as $time => $temp) {
                echo "<div class='weather-card'>";
                echo "<div class='weather-time'>$time</div>";
                echo "<div class='weather-temp'>$temp °C</div>";
                echo "</div>";
            }
            echo "</div>";
            echo "</div>";
        }
    ?>

</body>
</html>
