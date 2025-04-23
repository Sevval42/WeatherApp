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
        if(isset($air)){
            echo "<div class='weather-container'>";
            echo "<div class='weather-header'>";
            echo "<div class='weather-title'>Die Luftqualität in {$cityName}, {$country}</div>";
            echo "<p class='weather-coordinates'>({$lat}, {$long})</p>";
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
    } 
?>
