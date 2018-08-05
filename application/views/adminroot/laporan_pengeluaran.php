<!-- title container -->
            <div class="block-header">
                <h2><b>Pengelolaan Pengeluaran</b></h2>
            </div>
            <!-- end title container -->

            <!-- wraping container -->

            <!-- End warping container -->

             <!-- Colored Card - With Loading -->

            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Grafik Pengeluaran Pada Tahun <?= date('Y'); ?>
                            </h2>
                        </div>
                        <div class="body">
                            <div class="wrapper col-2"><canvas id="chart-penjualan-pertahun"></canvas></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Filter Laporan Perbulan
                            </h2>
                        </div>
                        <div class="body">
                            <form action="<?php echo base_url('adminroot/laporan_pengeluaran/sendParam'); ?>" method="POST">
                                <label for="password">Bulan</label>
                                <div class="form-group">
                                    <select class="form-control show-tick" name="bulan">
                                        <option value="">-- Pilih Bulan --</option>
                                        <option value="1">Januari</option>
                                        <option value="2">Februari</option>
                                        <option value="3">Maret</option>
                                        <option value="4">April</option>
                                        <option value="5">Mei</option>
                                        <option value="6">Juni</option>
                                        <option value="7">Juli</option>
                                        <option value="8">Agustus</option>
                                        <option value="9">September</option>
                                        <option value="10">Oktober</option>
                                        <option value="11">November</option>
                                        <option value="12">Desember</option>
                                    </select>
                                </div>

                                <label for="email_address">Tahun</label>
                                <div class="form-group">
                                    <select class="form-control show-tick" name="tahun">
                                        <option value="">-- Pilih Tahun --</option>
                                        <?php 
                                            foreach ($tahun as $thn): ?>
                                                <option value='<?= $thn->Tahun; ?>'><?= $thn->Tahun; ?></option>
                                            <?php 
                                            endforeach;
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group cs-rm-margin-btn">
                                    <button type="submit" class="btn btn-block btn-lg btn-primary waves-effect" >
                                        <i class="material-icons">search</i>
                                        <span>Laporan Pengeluaran</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Filter Laporan Pertahun
                            </h2>
                        </div>
                        <div class="body">
                            <form action="<?php echo base_url('adminroot/laporan_pengeluaran/sendParamTahun'); ?>" method="POST">
                                <label for="password">Tahun</label>
                                <div class="form-group">
                                    <select class="form-control show-tick" name="tahun">
                                        <option value="">-- Pilih Tahun --</option>
                                        <?php 
                                            foreach ($tahun as $thn): ?>
                                                <option value='<?= $thn->Tahun; ?>'><?= $thn->Tahun; ?></option>
                                            <?php 
                                            endforeach;
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group cs-rm-margin-btn ">
                                    <button type="submit" class="btn btn-block btn-lg btn-primary waves-effect cs-margin-top-tahun" >
                                        <i class="material-icons">search</i>
                                        <span>Filter Laporan Pertahun</span> 
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                
            </div>
            </div>
            <!-- #END# Colored Card - With Loading -->
            <script src="<?php echo base_url('assets/plugins/jquery/jquery.min.js'); ?>"></script>

            <!-- jquery-autocomplete Js -->
            <script src="<?php echo base_url('assets/js/EasyAutocomplete/jquery.easy-autocomplete.js'); ?>"></script>

            <!-- Moment Plugin Js -->
            <script src="<?php echo base_url('assets/plugins/momentjs/moment.js'); ?>"></script>

            <!-- Bootstrap Material Datetime Picker Plugin Js -->
            <script src="<?php echo base_url('assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js'); ?>"></script>

            <!-- Chart Js -->
            <script src="<?php echo base_url('assets/js/Chartjs/Chart.js'); ?>"></script>

            <script>
                $('#date').bootstrapMaterialDatePicker({format : 'DD-MM-YYYY', time: false });      

        // document.getElementById('tanggalNow').innerHTML(fullDate);

            var chartPenjualanPertahun = document.getElementById('chart-penjualan-pertahun').getContext('2d');

            var pengeluaran;

            $.getJSON('<?= base_url('adminroot/laporan_pengeluaran/getPengeluaranPerTahun') ?>', function(data) {
                console.log(data);

                pengeluaran = data;

                var chart = new Chart(chartPenjualanPertahun, {
                    type: 'line',

                    data: {
                        labels: ["January", "February", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"],
                        datasets: [{
                            label: "Pengeluaran Pertahun",
                            borderColor: 'rgba(0, 188, 212, 0.75)',
                            backgroundColor: 'rgba(0, 188, 212, 0.3)',
                            pointBorderColor: 'rgba(0, 188, 212, 0)',
                            pointBackgroundColor: 'rgba(0, 188, 212, 0.9)',
                            pointBorderWidth: 1,

                            data: [
                                data["1"],
                                data["2"],
                                data["3"],
                                data["4"],
                                data["5"],
                                data["6"],
                                data["7"],
                                data["8"],
                                data["9"],
                                data["10"],
                                data["11"],
                                data["12"]
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