<?php
namespace my\space;
const DB_USER = 'test_user';
const DB_PSWD = '123';
const DB_HOST = 'db';
const DB_NAME = 'test';

date_default_timezone_set('Etc/GMT-3');
$dbcon = mysqli_connect(DB_HOST, DB_USER, DB_PSWD, DB_NAME);
$sqlget = "select date(max(date)-1) as max_date, min(date) as min_date from weather";
$sqldata = mysqli_query($dbcon, $sqlget) or die('error');
$row = mysqli_fetch_array($sqldata, MYSQLI_ASSOC);
$max_data = $row['max_date'];
$min_data = $row['min_date'];