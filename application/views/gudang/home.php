<!-- title container -->
<div class="block-header">
    <h2>Informasi Bagian Gudang</h2>
</div>
<!-- end title container -->

<?= showflashMessage(); ?>

<!-- wraping container -->
<div class="row">
    <!-- start contain in container -->
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box-4 hover-zoom-effect">
            <div class="icon">
                <i class="material-icons col-pink">shopping_cart</i>
            </div>
            <div class="content">
                <div class="text">Total Pesanan /Hari</div>
                <div class="number"><?= $jumlahPesanan[0]->Total; ?></div>
                <a href="<?= site_url('gudang/pesanan'); ?>" title="Lihat">Lihat</a>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box-4 hover-zoom-effect">
            <div class="icon">
                <i class="material-icons col-blue">store</i>
            </div>
            <div class="content">
                <div class="text">Total Stok</div>
                <div class="number"><?= $jumlahStok[0]->Total; ?></div>
                <a href="<?= site_url('gudang/stok'); ?>" title="Lihat">Lihat</a>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box-4 hover-zoom-effect">
            <div class="icon">
                <i class="material-icons col-light-blue">cached</i>
            </div>
            <div class="content">
                <div class="text">Total Retur /Hari</div>
                <div class="number"><?= $jumlahRetur[0]->total_retur; ?></div>
                <a href="<?= site_url('gudang/retur'); ?>" title="Lihat">Lihat</a>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box-4 hover-zoom-effect">
            <div class="icon">
                <i class="material-icons col-cyan">today</i>
            </div>
            <div class="content">
                <div class="text"><?= date('l'); ?></div>
                <div class="h4"><?= date('d-M-Y'); ?></div>
            </div>
        </div>
    </div>
    <!-- end contain in container -->
</div>
<!-- End warping container -->

<div class="row clearfix">
    <!-- Line Chart -->
    <div class="col-lg-12 col-md-4 col-sm-6 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>Grafik Pemesanan Barang Selesai pada bulan <?= date('M'); ?></h2>
            </div>
            <div class="body">
                <div class="wrapper col-2">
                    <canvas id="chart-pemesanan"></canvas>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Line Chart -->
</div>

<!-- jQuery Core Js -->
<script src="<?php echo base_url('assets/plugins/jquery/jquery.min.js'); ?>"></script>

<!-- Chart Plugins Js -->
<script src="<?= base_url('assets/js/Chartjs/Chart.js'); ?>"></script>

<script>
    var hj;

    var chartPemesanan = document.getElementById('chart-pemesanan').getContext('2d');

    $.getJSON('<?= base_url('gudang/home/getDataJumlahPemasukan') ?>', function(data) {

        hj = data;

        var chart = new Chart(chartPemesanan, {
            type: 'line',

            data: {
                labels: ["01","02","03","04","05","06","07","08","09","10",
                    "11","12","13","14","15","16","17","18","19","20",
                    "21","22","23","24","25","26","27","28","29","30","31"],
                datasets: [{
                    label: "Pemasukan Barang Selesai",
                    borderColor: 'rgba(0, 188, 212, 0.75)',
                    backgroundColor: 'rgba(0, 188, 212, 0.3)',
                    pointBorderColor: 'rgba(0, 188, 212, 0)',
                    pointBackgroundColor: 'rgba(0, 188, 212, 0.9)',
                    pointBorderWidth: 1,

                    data: [
                        data["01"],
                        data["02"],
                        data["03"],
                        data["04"],
                        data["05"],
                        data["06"],
                        data["07"],
                        data["08"],
                        data["09"],
                        data["10"],
                        data["11"],
                        data["12"],
                        data["13"],
                        data["14"],
                        data["15"],
                        data["16"],
                        data["17"],
                        data["18"],
                        data["19"],
                        data["20"],
                        data["21"],
                        data["22"],
                        data["23"],
                        data["24"],
                        data["25"],
                        data["26"],
                        data["27"],
                        data["28"],
                        data["29"],
                        data["30"],
                        data["31"],
                    ],
                }]
            },

            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }

        });

    });
    
</script>