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
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box-4 hover-zoom-effect">
                                <div class="icon">
                                    <i class="material-icons col-blue">shopping_cart</i>
                                </div>
                                <div class="content">
                                    <div class="text">Total Item Terjual</div>
                                    <div class="number"><h4>0</h4></div>
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
                                    <div class="number"><h4><?= 'Rp. '.strrev(implode('.',str_split(strrev(strval(0)),3))); ?></h4></div>
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
                                    <div class="number"><h4><?= 'Rp. '.strrev(implode('.',str_split(strrev(strval(0)),3))); ?></h4></div>
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
                                    <div class="number"><h4><?= 'Rp. '.strrev(implode('.',str_split(strrev(strval(0)),3))); ?></h4></div>
                                </div>
                            </div>
                        </div>
                <?php } ?>  
                <!-- end contain in container -->
            </div>

            
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                <b>Riwayat Pendapatan <?= $startDate; ?> sampai <?= $endDate; ?></b>
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
                                            if (!empty($laporanTargetPendapatan)) {
                                                $no = 1;

                                                foreach ($laporanTargetPendapatan as $data): ?>

                                                <tr>
                                                    <th scope="row"><?= $no; ?></th>
                                                    <td><?= $data->id_barang; ?></td>
                                                    <td><?= $data->produk; ?></td>
                                                    <td><?= $data->total_item_terjual; ?></td>
                                                    <td><?= 'Rp. '.strrev(implode('.',str_split(strrev(strval($data->total_biaya_pembuatan)),3))); ?></td>
                                                    <td><?= 'Rp. '.strrev(implode('.',str_split(strrev(strval($data->total_target_pemasukan)),3))); ?></td>
                                                    <td><?= 'Rp. '.strrev(implode('.',str_split(strrev(strval($data->total_target_pendapatan)),3))); ?></td>
                                                    <td>
                                                        <center>
                                                            <a href="<?php echo base_url('adminroot/DetailLaporanPemasukan/getDetailByBarangBetween/').$data->id_barang."/".$startDate."/".$endDate; ?>" class="btn btn-primary waves-effect btn-detail"><i class="material-icons">remove_red_eye</i>Detail</a>
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
                                <h4 class="h5 cs-rm-margin-top"><b><i>*Hasil belum dikalkulasi dengan potogan harga dari transaksi</i></b></h5> 
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



            