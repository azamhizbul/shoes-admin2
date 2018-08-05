<!-- title container -->
<div class="block-header">
    <h2><b>Laporan Pendapatan</b></h2>
</div>
<!-- end title container -->
 <!-- Colored Card - With Loading -->
            <div class="row">
                <!-- start contain in container -->
                <?php 
                    if (!empty($pendapatan)) {
                        $no = 1;

                        foreach ($pendapatan as $data): ?>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box-4 hover-zoom-effect">
                                <div class="icon">
                                    <i class="material-icons col-blue">shopping_cart</i>
                                </div>
                                <div class="content">
                                    <div class="text">Total Item Terjual</div>
                                    <div class="number"><h4><?= $data->total_transaksi; ?></h4></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box-4 hover-zoom-effect">
                                <div class="icon">
                                    <i class="material-icons col-blue">input</i>
                                </div>
                                <div class="content">
                                    <div class="text">Total Pemasukan</div>
                                    <div class="number"><h4><?= 'Rp. '.strrev(implode('.',str_split(strrev(strval($data->total_pemasukan)),3))); ?></h4></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box-4 hover-zoom-effect">
                                <div class="icon">
                                    <i class="material-icons col-light-blue">swap_horiz</i>
                                </div>
                                <div class="content">
                                    <div class="text">Total Modal</div>
                                    <div class="number"><h4><?= 'Rp. '.strrev(implode('.',str_split(strrev(strval($data->total_modal)),3))); ?></h4></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box-4 hover-zoom-effect">
                                <div class="icon">
                                    <i class="material-icons col-light-blue">turned_in_not</i>
                                </div>
                                <div class="content">
                                    <div class="text">Total Diskon</div>
                                    <div class="number"><h4><?= 'Rp. '.strrev(implode('.',str_split(strrev(strval($data->total_potongan)),3))); ?></h4></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box-4 hover-zoom-effect">
                                <div class="icon">
                                    <i class="material-icons col-light-blue">done_all</i>
                                </div>
                                <div class="content">
                                    <div class="text">Pendapatan Bersih</div>
                                    <div class="number"><h4><?= 'Rp. '.strrev(implode('.',str_split(strrev(strval($data->total_pendapatan)),3))); ?></h4></div>
                                </div>
                            </div>
                        </div>
                        <?php $no++;
                        endforeach;
                    } else { ?>
                        <tr class="alert alert-danger">
                            <td colspan="9" align="center">Tidak ada daftar barang.</td>
                        </tr>   
                <?php } ?>  
                <!-- end contain in container -->
            </div>

            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Grafik Pendapatan
                            </h2>
                        </div>
                        <div class="body">
                            <div class="wrapper col-2"><canvas id="chart-penjualan"></canvas></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                <b>Filter Laporan Pendapatan</b>
                            </h2>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-md-12">
                                    <form action="<?php echo base_url('adminroot/laporan_pemasukan/filterPemasukan'); ?>" method="post">
                                        <b>Tanggal Awal</b>
                                        <div class="form-group form-group-lg">
                                            <div class="form-line">
                                                 <input type="text" name="dateStart" id="dateStart" class="form-control date" placeholder="Ex: 30/07/2016">
                                            </div>
                                        </div>
                                        <b>Tanggal Awal</b>
                                        <div class="form-group form-group-lg">
                                            <div class="form-line">
                                                 <input type="text" name="dateEnd" id="dateEnd" class="form-control date" placeholder="Ex: 30/07/2016">
                                            </div>
                                        </div>
                                        <div class="form-group cs-rm-margin-btn">   
                                        <button type="submit" class="btn btn-block btn-lg btn-primary waves-effect btn-detail cs-margin-notif" >
                                            <i class="material-icons">search</i>
                                            <span>Filter Pendapatan</span>
                                        </button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                <b>Riwayat Pendapatan Tahun Ini</b>
                            </h2>
                        </div>

                        <div class="body">
                            <div class="table-responsive cs-table-xflow">
                                <table class="table table-bordered table-striped table-hover dataTable js-basic-example cs-data-table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Id Barang</th>
                                            <th>Nama Produk</th>
                                            <th>Item Terjual</th>
                                            <th>Total Biaya Pembuatan</th>
                                            <th>Pemasukan*</th>
                                            <th>Pendapatan*</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php 
                                            if (!empty($pemasukan)) {
                                                $no = 1;

                                                foreach ($pemasukan as $barang): ?>

                                                <tr>
                                                    <th scope="row"><?= $no; ?></th>
                                                    <td><?= $barang->id_barang; ?></td>
                                                    <td><?= $barang->produk; ?></td>
                                                    <td><?= $barang->total_item_terjual; ?></td>
                                                    <td><?= 'Rp. '.strrev(implode('.',str_split(strrev(strval($barang->total_biaya_pembuatan)),3))); ?></td>
                                                    <td><?= 'Rp. '.strrev(implode('.',str_split(strrev(strval($barang->total_target_pemasukan)),3))); ?></td>
                                                    <td><?= 'Rp. '.strrev(implode('.',str_split(strrev(strval($barang->total_target_pendapatan)),3))); ?></td>
                                                    <td>
                                                        <center>
                                                            <a href="<?php echo base_url('adminroot/laporan_pemasukan/getDetailByBarang/').$barang->id_barang; ?>" class="btn btn-primary waves-effect btn-detail"><i class="material-icons">remove_red_eye</i>Detail</a>
                                                        </center>
                                                    </td>
                                                </tr>

                                                <?php $no++;
                                                endforeach;
                                            } else { ?>
                                                <tr class="alert alert-danger">
                                                    <td colspan="9" align="center">Tidak ada daftar barang.</td>
                                                </tr>   
                                        <?php } ?>  
                                    </tbody>
                                </table>
                                <h4 class="h5 cs-rm-margin-top"><b><i>*Hasil belum dikalkulasi dengan potogan harga dari transaksi</i></b></h4>
                            </div>
                        </div>                        
                    </div>
                </div>
            </div>

            
            <!-- #END# Colored Card - With Loading -->
            <!-- #END# Colored Card - With Loading -->
            <script src="<?php echo base_url('assets/plugins/jquery/jquery.min.js'); ?>"></script>

            <!-- Input Mask Plugin Js -->
            <script src="<?php echo base_url('assets/plugins/jquery-inputmask/jquery.inputmask.bundle.js'); ?>"></script>

            <!-- jquery-autocomplete Js -->
            <script src="<?php echo base_url('assets/js/EasyAutocomplete/jquery.easy-autocomplete.js'); ?>"></script>

            <!-- Moment Plugin Js -->
            <script src="<?php echo base_url('assets/plugins/momentjs/moment.js'); ?>"></script>

            <!-- Bootstrap Material Datetime Picker Plugin Js -->
            <script src="<?php echo base_url('assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js'); ?>"></script>

            <!-- Chart Js -->
            <script src="<?php echo base_url('assets/js/Chartjs/Chart.js'); ?>"></script>



            <script>
                $('#dateStart').bootstrapMaterialDatePicker({format : 'YYYY-MM-DD', time: false });      
                $('#dateEnd').bootstrapMaterialDatePicker({format : 'YYYY-MM-DD', time: false }); 
            var options = {
                url: "<?php echo base_url('reseller.json'); ?>",

                getValue: "name",

            template: {
                        type: "description",
                        fields: {
                            description: "email"
                         }
            },

            list: {
                match: {
                    enabled: true
                },
            },

            theme: "plate-dark"
            };

                var ctx = document.getElementById('chart-penjualan').getContext('2d');

                var chart = new Chart(ctx, {
                    // The type of chart we want to create
                    type: 'line',

                    // The data for our dataset
                    data: {
                        labels: ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober",
                        "November","Desember"],
                        datasets: [{
                            label: "Pendapatan",
                            backgroundColor: 'rgb(255, 99, 132,0.3)',
                            borderColor: 'rgb(255, 99, 132)',
                            data: [0, 10, 5, 2, 20, 30, 45,60,97,52,0, 10],
                        }]
                    },

                    // Configuration options go here
                    options: {}
                });
            </script>
