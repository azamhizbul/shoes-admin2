<!-- title container -->
<div class="block-header">
    <div class="row clearfix">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <h2><b>Laporan Pendapatan</b></h2>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            
        </div>
    </div>
    
</div>
<!-- end title container -->
 <!-- Colored Card - With Loading -->
                     
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                <b>Detail Transaksi End User</b>
                            </h2>
                        </div>

                        <div class="body">
                            <div class="table-responsive cs-table-xflow">
                                <table class="table table-bordered table-striped table-hover dataTable js-basic-example cs-data-table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Id Transaksi</th>
                                            <th>Tanggal Transaksi</th>
                                            <th>Produk</th>
                                            <th>Total Item</th>
                                            <th>Harga Satuan</th>
                                            <th>Total*</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php 
                                            if (!empty($detailEndUser)) {
                                                $no = 1;

                                                foreach ($detailEndUser as $data): ?>

                                                <tr>
                                                    <th scope="row"><?= $no; ?></th>
                                                    <td><?= $data->id_transaksi_end_user; ?></td>
                                                    <td><?= $data->tgl_jual; ?></td>
                                                    <td><?= $data->produk; ?></td>
                                                    <td><?= $data->total_item; ?></td>
                                                    <td><?= 'Rp. '.strrev(implode('.',str_split(strrev(strval($data->harga_end_user)),3))); ?></td>
                                                    <td><?= 'Rp. '.strrev(implode('.',str_split(strrev(strval($data->total_harga)),3))); ?></td>
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
                                <a href="<?= base_url('adminroot/laporan_pemasukan/') ?>" title="Kembali" class="btn bg-blue header-dropdown m-r--5">
                                    <i class="material-icons">keyboard_return</i>
                                    <span>Kembali</span>
                                </a> 
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
                                <b>Detail Transaksi Reseller</b>
                            </h2>
                        </div>

                        <div class="body">
                            <div class="table-responsive cs-table-xflow">
                                <table class="table table-bordered table-striped table-hover dataTable js-basic-example cs-data-table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Id Transaksi</th>
                                            <th>Tanggal Transaksi</th>
                                            <th>Produk</th>
                                            <th>Total Item</th>
                                            <th>Harga Satuan</th>
                                            <th>Total*</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php 
                                            if (!empty($detailReseller)) {
                                                $no = 1;

                                                foreach ($detailReseller as $data): ?>

                                                <tr>
                                                    <th scope="row"><?= $no; ?></th>
                                                    <td><?= $data->id_transaksi_reseller; ?></td>
                                                    <td><?= $data->tgl_jual; ?></td>
                                                    <td><?= $data->produk; ?></td>
                                                    <td><?= $data->total_item; ?></td>
                                                    <td><?= 'Rp. '.strrev(implode('.',str_split(strrev(strval($data->harga_reseller)),3))); ?></td>
                                                    <td><?= 'Rp. '.strrev(implode('.',str_split(strrev(strval($data->total_harga)),3))); ?></td>
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
                                <a href="<?= base_url('adminroot/laporan_pemasukan/') ?>" title="Kembali" class="btn bg-blue header-dropdown m-r--5">
                                    <i class="material-icons">keyboard_return</i>
                                    <span>Kembali</span>
                                </a>  
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
                                <b>Detail Transaksi Merk</b>
                            </h2>
                        </div>

                        <div class="body">
                            <div class="table-responsive cs-table-xflow">
                                <table class="table table-bordered table-striped table-hover dataTable js-basic-example cs-data-table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Id Transaksi</th>
                                            <th>Tanggal Transaksi</th>
                                            <th>Produk</th>
                                            <th>Total Item</th>
                                            <th>Harga Satuan</th>
                                            <th>Total*</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php 
                                            if (!empty($detailMerk)) {
                                                $no = 1;

                                                foreach ($detailMerk as $data): ?>

                                                <tr>
                                                    <th scope="row"><?= $no; ?></th>
                                                    <td><?= $data->id_transaksi_merk; ?></td>
                                                    <td><?= $data->tgl_jual; ?></td>
                                                    <td><?= $data->produk; ?></td>
                                                    <td><?= $data->total_item; ?></td>
                                                    <td><?= 'Rp. '.strrev(implode('.',str_split(strrev(strval($data->harga_merk)),3))); ?></td>
                                                    <td><?= 'Rp. '.strrev(implode('.',str_split(strrev(strval($data->total_harga)),3))); ?></td>
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
                                <a href="<?= base_url('adminroot/laporan_pemasukan/') ?>" title="Kembali" class="btn bg-blue header-dropdown m-r--5">
                                    <i class="material-icons">keyboard_return</i>
                                    <span>Kembali</span>
                                </a> 
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



            