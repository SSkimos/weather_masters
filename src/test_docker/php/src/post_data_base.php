<?php
const DB_USER_NEW = 'test_user';
const DB_PSWD_NEW = '123';
const DB_HOST_NEW = 'db';
const DB_NAME_NEW = 'test';
$dbcon = mysqli_connect(DB_HOST_NEW, DB_USER_NEW, DB_PSWD_NEW, DB_NAME_NEW);
$sqlget = "select time, temp, pres, humidity from weather where date = '" . $_POST['calendar'] . "' order by time";
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