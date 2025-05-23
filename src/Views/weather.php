<?php 
    if(isset($lat)) {
        echo "<div class='selection'>";
        $city['info'] = 'weather';
        $request = json_encode($city);
        echo "<form action='/weather/{$cityName}/{$country}/$lat/$long' method='GET'>";
        echo "<button type='submit' name='searchQuery' value='$searchQuery'>Wetter</button>";
        echo "</form>";
        
        echo "<form action='/air/{$cityName}/{$country}/$lat/$long' method='GET'>";
        echo "<button type='submit' name='searchQuery' value='$searchQuery'>Luftqualität</button>";
        echo "</form>";
        
        echo "</div>";
        
        if (isset($weather)) {
            $weather = $weather['weather'];
            echo "<div class='weather-container'>";
            echo "<div class='weather-header'>";
            echo "<div class='weather-title'>Das Wetter in {$cityName}, {$country}</div>";
            echo "<p class='weather-coordinates'>({$lat}, {$long})</p>";
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
    } 
?>
