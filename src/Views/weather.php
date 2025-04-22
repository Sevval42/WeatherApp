<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/style.css">
</head>
<body>
    <h2>Wetter brrr</h2>
    <form id="searchForm" action="/search/" method="GET" onsubmit="updateAction()">
        Stadt: <input type="text" id="cityInput">
        <input type="submit">
    </form>
    

    <script>
    function updateAction() {
        const input = document.getElementById('cityInput').value.trim();
        const form = document.getElementById('searchForm');

        if (input) {
            form.action = "/search/" + encodeURIComponent(input);
        } else {
            alert("Please enter a city name.");
            event.preventDefault();
        }
    }
    </script>

    <?php
        if(isset($cityList)){
            foreach ($cityList as $currentCity) {
                $text = "{$currentCity['name']}, {$currentCity['country_code']} ({$currentCity['lat']}, {$currentCity['long']})";
                $currentCity['cityList'] = $cityList;
                $cityInfo = json_encode($currentCity);
                echo "<form action='/$weatherOrAir/{$currentCity['name']}/{$currentCity['country_code']}/{$currentCity['lat']}/{$currentCity['long']}' method='GET'>";
                echo "<button type='submit' name='searchQuery' value='$searchQuery' class='city-button'>$text</button>";
                echo '</form>';
            }
        }
    ?>

    <?php if(isset($lat)) {?>
    
    <div class="selection">
    <?php 
    $city['info'] = 'weather';
    $request = json_encode($city);
    echo "<form action='/weather/{$cityName}/{$country}/$lat/$long' method='GET'>";
    echo "<button type='submit' name='searchQuery' value='$searchQuery'>Wetter</button>";
    echo "</form>";
    
    echo "<form action='/air/{$cityName}/{$country}/$lat/$long' method='GET'>";
    echo "<button type='submit' name='searchQuery' value='$searchQuery'>Luftqualität</button>";
    echo "</form>";
    
    ?>
    </div>
    
    <?php 
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
    ?>
    <?php } ?>

</body>
</html>
