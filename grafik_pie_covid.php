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
<title>Pie Chart</title>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<div id="canvas-holder" style="width: 50%">
    <canvas id="chart-area"></canvas>
</div>
<script>
var config = {
    type: 'pie',
    data: {
        datasets: [{
            data: <?php echo json_encode($total_cases); ?>,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            label: 'Total Cases'
        }],
        labels: <?php echo json_encode($country_other); ?>
    },
    options: {
        responsive: true
    }
};

document.addEventListener('DOMContentLoaded', function() {
    var ctx = document.getElementById('chart-area').getContext('2d');
    window.myPie = new Chart(ctx, config);
});
</script>
</body>
</html>
