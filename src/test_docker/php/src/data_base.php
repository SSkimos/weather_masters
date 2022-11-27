<?php
use const my\space\DB_NAME;
use const my\space\DB_PSWD;
use const my\space\DB_HOST;
use const my\space\DB_USER;
$dbcon = mysqli_connect(DB_HOST, DB_USER, DB_PSWD, DB_NAME);
$sqlget = "select date(max(date)-1) as max_date from weather";
$sqldata = mysqli_query($dbcon, $sqlget) or die('error');
$row = mysqli_fetch_array($sqldata, MYSQLI_ASSOC);
$max_date = $row['max_date'];
$sqlget = "select time, temp, pres, humidity from weather where date = '" . $max_date . "' order by time";
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