<?php
function displayWeather(array $weather)
{
    $info = $weather['info'];
    $weather = $weather['weather'];
    echo "<h3>Das Wetter in {$info['name']}, {$info['country_code']}</h3>";
    echo "<p>({$info['lat']}, {$info['long']})</p>";
    echo "<div class='weather-container'>";
        
        foreach ($weather as $time => $temp) {
            echo "<div class='weather-card'>";
            echo "<div class='weather-time'>$time</div>";
            echo "<div class='weather-temp'>$temp °C</div>";
            echo "</div>";
        }
        echo "</div>";
}
?>