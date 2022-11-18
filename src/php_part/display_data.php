<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../weather-icons-master/css/weather-icons-wind.min.css">
    <link rel="stylesheet" href="../weather-icons-master/css/weather-icons.css">
    <link rel="stylesheet" href="../weather-icons-master/css/weather-icons.min.css">
    <title>Document</title>
</head>

<body>
<header>
    <nav class="container">
        <div class="message_today">
            Weather Today
        </div>
        <div class = "date_block">
            <div id="current_date_time_block"></div>
        </div>
    </nav>
</header>

<div class="row">
    <div class = "column">
        <canvas class="temp_chart">

        </canvas>
    </div>
    <div class = "column">
        <canvas class="humidity_chart">

        </canvas>
    </div>
</div>
<div class="row">
    <div class="column">
        <canvas class="pressure_chart">

        </canvas>
    </div>
    <div class="column">
        <div style="height: 400px; overflow-y:auto; border-radius: 10px;">
            <?php
            const DB_USER = 'test_user';
            const DB_PSWD = '123';
            const DB_HOST = '127.0.0.1';
            const DB_NAME = 'test';
            const DB_PORT = '3306';
            date_default_timezone_set('Etc/GMT-3');
            $date = date("Y-m-d");
            $dbcon = mysqli_connect(DB_HOST, DB_USER, DB_PSWD, DB_NAME, DB_PORT);
            $sqlget = "select time, temp, pres, humidity from weather where date = '" . $date . "'";
            $sqldata = mysqli_query($dbcon, $sqlget) or die('error');

            echo "<table class='table_weather'>";
            echo "<tr><th>$date</th><th>Температура</th><th>Давление</th><th>Влажность</th>";

            while ($row = mysqli_fetch_array($sqldata, MYSQLI_ASSOC)){
                echo "<tr><td>";
                echo $row['time'];
                echo "</td><td>";
                echo $row['temp'];
                echo "</td><td>";
                echo $row['pres'];
                echo "</td><td>";
                echo $row['humidity'];
                echo "</td></tr>";
            }

            echo"</table>";
            ?>
        </div>
    </div>
</div>

<script type="text/javascript" src="current_date_time.js"></script>
