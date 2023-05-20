<!DOCTYPE html>
<html lang="en">
<?php include 'max_min_data.php';?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>

<body>
<header>
    <nav class="container">
        <div class="message_today">
            Weather Today
        </div>
        <form class = "date_block", action="post_index.php", method="post">
            <label>
                <input type="date" name="calendar" value="<?php echo $max_data?>"
                       max="<?php echo $max_data?>" min="<?php echo $min_data?>" , class="calendar_block_n", onchange='this.form.submit()'>
            </label>
        </form>
    </nav>
</header>

<div class="row">
    <div class = "column">
        <canvas class="temp_chart" id="TempChart"></canvas>
    </div>
    <div class = "column">
        <canvas class="humidity_chart" id="HumChart"> </canvas>
    </div>
</div>
<div class="row">
    <div class="column">
        <canvas class="pressure_chart" id="PresChart"></canvas>
    </div>
    <div class="column">
        <div style="height: 350px; overflow-y:auto; border-radius: 10px;">
            <?php include 'data_base.php';?>
        </div>
    </div>
</div>

<script type="text/javascript" src="current_date_time.js"></script>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('TempChart');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: [<?php echo join(', ', $array_time)?>],
            datasets: [{
                label: 'Temperature',
                data: [<?php echo join(', ', $array_temp)?>],
                borderWidth: 2
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    const ctx_2 = document.getElementById('PresChart');

    new Chart(ctx_2, {
        type: 'line',
        data: {
            labels: [<?php echo join(', ', $array_time)?>],
            datasets: [{
                label: 'Pressure in mmHG',
                data: [<?php echo join(', ', $array_pres)?>],
                borderWidth: 2
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    const ctx_3 = document.getElementById('HumChart');

    new Chart(ctx_3, {
        type: 'line',
        data: {
            labels: [<?php echo join(', ', $array_time)?>],
            datasets: [{
                label: 'Humidity',
                data: [<?php echo join(', ', $array_hum);?>],
                borderWidth: 2
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
</body>
