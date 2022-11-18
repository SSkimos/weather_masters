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
$array_temp = [];
$array_hum = [];
$array_pres = [];
$array_time = [];
while ($row = mysqli_fetch_array($sqldata, MYSQLI_ASSOC)){
    $array_temp[] = $row['temp'];
}
$sqldata = mysqli_query($dbcon, $sqlget) or die('error');
while ($row = mysqli_fetch_array($sqldata, MYSQLI_ASSOC)){
    $array_hum[] = $row['humidity'];
}
$sqldata = mysqli_query($dbcon, $sqlget) or die('error');
while ($row = mysqli_fetch_array($sqldata, MYSQLI_ASSOC)){
    $array_pres[] = $row['pres'];
}
$sqldata = mysqli_query($dbcon, $sqlget) or die('error');
while ($row = mysqli_fetch_array($sqldata, MYSQLI_ASSOC)){
    $array_time[] = "'".$row['time']."'";
}
$sqldata = mysqli_query($dbcon, $sqlget) or die('error');
echo "<table class='table_weather'>";
echo "<tr><th>Дата</th><th>Температура</th><th>Давление</th><th>Влажность</th>";
while ($row = mysqli_fetch_array($sqldata, MYSQLI_ASSOC)){
    echo "<tr><td>";
    echo $row['time'];
    echo "</td><td>";
    echo $row['temp'].'°';
    echo "</td><td>";
    echo $row['pres'].' mm rs';
    echo "</td><td>";
    echo $row['humidity'].'%';
    echo "</td></tr>";
}


echo"</table>";
?>