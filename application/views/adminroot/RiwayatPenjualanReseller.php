 <!-- Colored Card - With Loading -->
<div class="block-header">
    <h2>
        Riwayat Penjualan Reseller
    </h2>
</div>

<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Riwayat penjualan reseller oleh Admin
                </h2>
            </div>
            <div class="body">
                <div class="table-responsive cs-table-xflow">
                    <table class="table table-bordered table-striped table-hover dataTable js-basic-example cs-data-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Transaksi</th>
                                <th>Tanggal Transaksi</th>
                                <th>Nama Reseller</th>
                                <th>Jumlah Jual</th>
                                <th>Potongan Harga</th>
                                <th>Total Belanja</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($listhistorypenjualanreselleradmin)) {
                                $no = 1;

                                foreach ($listhistorypenjualanreselleradmin as $penjualanreseller) { ?>
                                    
                                    <tr>
                                        <th scope="row"><?= $no; ?></th>
                                        <td><?= $penjualanreseller->id_transaksi_reseller; ?></td>
                                        <td><?= $penjualanreseller->tgl_jual; ?></td>
                                        <td><?= $penjualanreseller->nama_reseller; ?></td>
                                        <td><?= $penjualanreseller->jumlah_jual; ?></td>
                                        <td><?= 'Rp. '.strrev(implode('.',str_split(strrev(strval($penjualanreseller->potongan_harga)),3))); ?></td>
                                        <?php if ($penjualanreseller->sisa_tagihan == 0){ ?>
                                            <td><?= 'Rp. '.strrev(implode('.',str_split(strrev(strval($penjualanreseller->total_tagihan)),3))); ?> <span class="label label-success">Lunas</span></td>
                                        <?php } else { ?>
                                            <td><?= 'Rp. '.strrev(implode('.',str_split(strrev(strval($penjualanreseller->total_tagihan)),3))); ?> <span class="label label-danger">Belum lunas</span></td>
                                        <?php } ?>
                                        <td>
                                            <a href="<?php echo base_url('adminroot/PenjualanAdmin/detailRiwayatPenjualanResellerAdmin/'.$penjualanreseller->id_transaksi_reseller); ?>" class="btn btn-primary waves-effect">
                                                <i class="material-icons">remove_red_eye</i>
                                                <span>Detail</span>
                                            </a>
                                        </td>
                                    </tr>
                            <?php $no++;
                                }
                            } else { ?>
                                    <tr class="alert alert-danger">
                                        <td colspan="8" align="center">Tidak ada riwayat penjualan reseller.</td>
                                    </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>            
    </div>    
</div>
<!-- #END# Colored Card - With Loading -->

<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Riwayat penjualan reseller oleh Kasir
                </h2>
            </div>
            <div class="body">
                <div class="table-responsive cs-table-xflow">
                    <table class="table table-bordered table-striped table-hover dataTable js-basic-example cs-data-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Transaksi</th>
                                <th>Tanggal Transaksi</th>
                                <th>Nama Reseller</th>
                                <th>Jumlah Jual</th>
                                <th>Potongan Harga</th>
                                <th>Total Belanja</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($listhistorypenjualanresellerkasir)) {
                                $no = 1;

                                foreach ($listhistorypenjualanresellerkasir as $penjualanreseller) { ?>
                                    
                                    <tr>
                                        <th scope="row"><?= $no; ?></th>
                                        <td><?= $penjualanreseller->id_transaksi_reseller; ?></td>
                                        <td><?= $penjualanreseller->tgl_jual; ?></td>
                                        <td><?= $penjualanreseller->nama_reseller; ?></td>
                                        <td><?= $penjualanreseller->jumlah_jual; ?></td>
                                        <td><?= 'Rp. '.strrev(implode('.',str_split(strrev(strval($penjualanreseller->potongan_harga)),3))); ?></td>
                                        <?php if ($penjualanreseller->sisa_tagihan == 0){ ?>
                                            <td><?= 'Rp. '.strrev(implode('.',str_split(strrev(strval($penjualanreseller->total_tagihan)),3))); ?> <span class="label label-success">Lunas</span></td>
                                        <?php } else { ?>
                                            <td><?= 'Rp. '.strrev(implode('.',str_split(strrev(strval($penjualanreseller->total_tagihan)),3))); ?> <span class="label label-danger">Belum lunas</span></td>
                                        <?php } ?>
                                        <td>
                                            <a href="<?php echo base_url('adminroot/PenjualanAdmin/detailRiwayatPenjualanResellerKasir/'.$penjualanreseller->id_transaksi_reseller); ?>" class="btn btn-primary waves-effect">
                                                <i class="material-icons">remove_red_eye</i>
                                                <span>Detail</span>
                                            </a>
                                        </td>
                                    </tr>
                            <?php $no++;
                                }
                            } else { ?>
                                    <tr class="alert alert-danger">
                                        <td colspan="8" align="center">Tidak ada riwayat penjualan reseller.</td>
                                    </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>            
    </div>    
</div>
<!-- #END# Colored Card - With Loading -->