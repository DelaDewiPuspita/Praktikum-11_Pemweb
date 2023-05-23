<?php
include('koneksidatacovid.php');
$data = mysqli_query($koneksi, "SELECT * FROM covid_data");
$country_other = array();
$total_cases = array();
$total_deaths = array();
$total_recovered = array();
$active_cases = array();
$total_tests = array();
$population = array();
while ($row = mysqli_fetch_array($data)) {
    $country_other[] = $row['country_other'];
    $total_cases[] = $row['total_cases'];
    $total_deaths[] = $row['total_deaths'];
    $total_recovered[] = $row['total_recovered'];
    $active_cases[] = $row['active_cases'];
    $total_tests[] = $row['total_tests'];
    $population[] = $row['population'];
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Membuat Grafik Menggunakan Chart JS</title>
<script type="text/javascript" src="Chart.js"></script>
</head>
<body>
<div style="width: 800px; height: 800px;">
    <canvas id="myChart"></canvas>
</div>
<script>
var ctx = document.getElementById("myChart").getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?php echo json_encode($country_other); ?>,
        datasets: [{
            label: 'Total Cases',
            data: <?php echo json_encode($total_cases); ?>,
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderColor: 'rgba(255,99,132,1)',
            borderWidth: 1
        }, {
            label: 'Total Deaths',
            data: <?php echo json_encode($total_deaths); ?>,
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }, {
            label: 'Total Recovered',
            data: <?php echo json_encode($total_recovered); ?>,
            backgroundColor: 'rgba(255, 206, 86, 0.2)',
            borderColor: 'rgba(255, 206, 86, 1)',
            borderWidth: 1
        }, {
            label: 'Active Cases',
            data: <?php echo json_encode($active_cases); ?>,
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
        }, {
            label: 'Total Tests',
            data: <?php echo json_encode($total_tests); ?>,
            backgroundColor: 'rgba(153, 102, 255, 0.2)',
            borderColor: 'rgba(153, 102, 255, 1)',
            borderWidth: 1
        }, {
            label: 'Population',
            data: <?php echo json_encode($population); ?>,
            backgroundColor: 'rgba(255, 159, 64, 0.2)',
            borderColor: 'rgba(255, 159, 64, 1)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>
</body>
</html>
