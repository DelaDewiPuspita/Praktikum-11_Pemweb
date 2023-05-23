<?php
include('koneksi.php');
$produk = mysqli_query($koneksi,"select * from tb_barang");
$nama_produk = array();
$jumlah_produk = array();
while($row = mysqli_fetch_array($produk)){
    $nama_produk[] = $row['barang'];
    $query = mysqli_query($koneksi,"select sum(jumlah) as jumlah from tb_penjualan where id_barang='".$row['id_barang']."'");
    $result = mysqli_fetch_array($query);
    $jumlah_produk[] = $result['jumlah'];
}
?>
<!doctype html>
<html>
<head>
<title>Pie Chart</title>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<div id="canvas-holder" style="width:50%">
<canvas id="chart-area"></canvas>
</div>
<script>
var config = {
    type: 'pie',
    data: {
        datasets: [{
            data: <?php echo json_encode($jumlah_produk); ?>,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)'
            ],
            label: 'Presentase Penjualan Barang'
        }],
        labels: <?php echo json_encode($nama_produk); ?>
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
