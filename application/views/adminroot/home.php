<?= showFlashMessage(); ?>

<!-- title container -->
<div class="block-header">
    <h2>Informasi Bagian Admin</h2>
</div>
<!-- end title container -->

<!-- wraping container -->
<div class="row">
    <!-- start contain in container -->
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box-4 hover-zoom-effect">
            <div class="icon">
                <i class="material-icons col-pink">shopping_cart</i>
            </div>
            <div class="content">
                <div class="text">Total Barang</div>
                <div class="number"><?= $barang[0]->total_stok; ?></div>
                <a href="<?= base_url('adminroot/Pengelolaan_barang'); ?>">Lihat</a>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box-4 hover-zoom-effect">
            <div class="icon">
                <i class="material-icons col-blue">shopping_basket</i>
            </div>
            <div class="content">
                <div class="text">Total Penjualan /Bulan</div>
                <div class="number"><?= $penjualan[0]->Total; ?></div>
                <a href="<?= base_url('adminroot/PenjualanAdmin/historyPenjualan'); ?>">Lihat</a>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box-4 hover-zoom-effect">
            <div class="icon">
                <i class="material-icons col-light-blue">insert_drive_file</i>
            </div>
            <div class="content">
                <div class="text">Total Invoice /Bulan</div>
                <?php  
                    if (isset($invoice[0]->invoice))  {
                         # code...
                        ?>
                        <div class="number"><?= $invoice[0]->invoice; ?></div><?php
                     } else {?>
                        <div class="number">0</div>
                        <?php
                 }?>
                
                <a href="<?= base_url('adminroot/invoice'); ?>">Lihat</a>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box-4 hover-zoom-effect">
            <div class="icon">
                <i class="material-icons col-light-blue">cached</i>
            </div>
            <div class="content">
                <div class="text">Total Retur /Bulan</div>
                <div class="number"><?= count($retur); ?></div>
                <a href="<?= base_url('adminroot/ReturPemesananAdmin'); ?>">Lihat</a>
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

<!-- Colored Card - With Loading -->
             <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Garfik Penjualan Bulan <?= date('M'); ?>
                            </h2>
                        </div>
                        <div class="body">
                            <div class="wrapper col-2">
                                <canvas id="chart-penjualan"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            <!-- #END# Colored Card - With Loading -->

            <!-- Jquery Core Js -->
            <script src="<?php echo base_url('assets/plugins/jquery/jquery.min.js'); ?>"></script>

            <!-- Chart Js -->
            <script src="<?php echo base_url('assets/js/Chartjs/Chart.js'); ?>"></script>

            <script>
                var chartPenjualan = document.getElementById('chart-penjualan').getContext('2d');

                var customerUrl = '<?= base_url('adminroot/home/getPenjualanPerHariCustomer'); ?>';

                var resellerUrl = '<?= base_urL('adminroot/home/getPenjualanPerHariReseller'); ?>';

                var customer, reseller;

                $.when(

                    $.getJSON(customerUrl, function(data) {
                        customer = data;
                        console.log(data);
                    }),

                    $.getJSON(resellerUrl, function (data) {
                        reseller = data;
                        console.log(data);
                    })

                ).then(function() {

                    var chart = new Chart(chartPenjualan, {

                        type: 'line',
                        data: {
                            labels: ["01","02","03","04","05","06","07","08","09","10",
                                    "11","12","13","14","15","16","17","18","19","20",
                                    "21","22","23","24","25","26","27","28","29","30","31"],
                            datasets: [{
                                label: "Penjualan Ke Konsumen",
                                backgroundColor: 'rgba(0, 188, 212,0.3)',
                                borderColor: 'rgba(0, 188, 212, 0.75)',
                                pointBorderColor: 'rgba(0, 188, 212, 0)',
                                pointBackgroundColor: 'rgba(0, 188, 212, 0.9)',
                                pointBorderWidth: 1,
                                data: [
                                    customer["01"],
                                    customer["02"],
                                    customer["03"],
                                    customer["04"],
                                    customer["05"],
                                    customer["06"],
                                    customer["07"],
                                    customer["08"],
                                    customer["09"],
                                    customer["10"],
                                    customer["11"],
                                    customer["12"],
                                    customer["13"],
                                    customer["14"],
                                    customer["15"],
                                    customer["16"],
                                    customer["17"],
                                    customer["18"],
                                    customer["19"],  
                                    customer["20"],
                                    customer["21"],
                                    customer["22"],
                                    customer["23"],
                                    customer["24"],
                                    customer["25"],
                                    customer["26"],
                                    customer["27"],
                                    customer["28"],
                                    customer["29"],
                                    customer["30"],
                                    customer["31"]
                                ],
                            },
                            {
                                label: "Penjualan Ke Reseller",
                                backgroundColor: 'rgb(255, 99, 132,0.3)',
                                borderColor: 'rgb(255, 99, 132)',
                                pointBorderColor: 'rgb(255, 99, 132, 0)',
                                pointBackgroundColor: 'rgb(255, 99, 132, 0.9)',
                                pointBorderWidth: 1,
                                data: [
                                    reseller["01"],
                                    reseller["02"],
                                    reseller["03"],
                                    reseller["04"],
                                    reseller["05"],
                                    reseller["06"],
                                    reseller["07"],
                                    reseller["08"],
                                    reseller["09"],
                                    reseller["10"],
                                    reseller["11"],
                                    reseller["12"],
                                    reseller["13"],
                                    reseller["14"],
                                    reseller["15"],
                                    reseller["16"],
                                    reseller["17"],
                                    reseller["18"],
                                    reseller["19"],
                                    reseller["20"],
                                    reseller["21"],
                                    reseller["22"],
                                    reseller["23"],
                                    reseller["24"],
                                    reseller["25"],
                                    reseller["26"],
                                    reseller["27"],
                                    reseller["28"],
                                    reseller["29"],
                                    reseller["30"],
                                    reseller["31"],
                                ]}
                            ]
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
