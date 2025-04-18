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
                foreach ($cityList as $currentCity) {
                    $text = "{$currentCity['name']}, {$currentCity['country_code']} ({$currentCity['lat']}, {$currentCity['long']})";
                    $currentCity['cityList'] = $cityList;
                    $cityInfo = json_encode($currentCity);
                    
                    echo "<button type='submit' name='city' class='city-button' value='$cityInfo'>$text</button>";
                }
            }
        ?>
    </form>
    <?php if(isset($city)) {?>
    
    <form action="index.php" method="POST">
        <div class="selection">
        <?php 
        $city['info'] = 'weather';
        $request = json_encode($city);
        echo "<button type='submit' name='city' value='$request'>Wetter</button>";
        $city['info'] = 'air';
        $request = json_encode($city);
        echo "<button type='submit' name='city' value='$request'>Luftqualität</button>";
        ?>
        </div>
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
        
        if(isset($air)){
            $info = $air['info'];
            $air = $air['air'];
            echo "<div class='weather-container'>";
            echo "<div class='weather-header'>";
            echo "<div class='weather-title'>Die Luftqualität in {$info['name']}, {$info['country_code']}</div>";
            echo "<p class='weather-coordinates'>({$info['lat']}, {$info['long']})</p>";
            echo "</div>";
            echo "<div class='weather-scroll'>";
            echo "<div class='weather-card'>";
            echo "<div class='weather-time'>Date</div>";
            echo "<div class='weather-temp'>Erle</div>";
            echo "<div class='weather-temp'>Birke</div>";
            echo "<div class='weather-temp'>Gräser</div>";
            echo "<div class='weather-temp'>Beifuß</div>";
            echo "<div class='weather-temp'>Olive</div>";
            echo "<div class='weather-temp'>Ambrosia</div>";
            echo "</div>";
            foreach ($air as $time => $type) {
                echo "<div class='weather-card'>";
                echo "<div class='weather-time'>$time</div>";
                foreach ($type as $pollen => $value) {
                    echo "<div class='weather-temp'>$value</div>";
                }
                echo "</div>";
            }
            echo "</div>";
            echo 'Angaben in Pollen/m^3';
            echo "</div>";
        }
    ?>
    <?php } ?>

</body>
</html>
