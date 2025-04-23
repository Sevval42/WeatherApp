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

</body>
</html>
