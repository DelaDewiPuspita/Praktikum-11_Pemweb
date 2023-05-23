<?php
include('koneksidatacovid.php');
$data = mysqli_query($koneksi, "SELECT * FROM covid_data");
$country_other = array();
$total_cases = array();
while ($row = mysqli_fetch_array($data)) {
    $country_other[] = $row['country_other'];
    $total_cases[] = $row['total_cases'];
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Grafik Total Kasus Covid</title>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
            label: 'Grafik Total Kasus Covid',
            data: <?php echo json_encode($total_cases); ?>,
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderColor: 'rgba(255, 99, 132, 1)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
                precision: 0
            }
        }
    }
});
</script>
</body>
</html>
