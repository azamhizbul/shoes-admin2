 <!-- Colored Card - With Loading -->
<div class="block-header">
    <h2>
        Riwayat Penjualan Merk
    </h2>
</div>

<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Riwayat penjualan Merk oleh Admin
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
                                <th>Nama Pembeli</th>
                                <th>Jumlah Jual</th>
                                <th>Potongan Harga</th>
                                <th>Total Belanja</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($riwayatTransaksiMerkAdmin)) {
                                $no = 1;

                                foreach ($riwayatTransaksiMerkAdmin as $riwayat) { ?>
                                    
                                    <tr>
                                        <th scope="row"><?= $no; ?></th>
                                        <td><?= $riwayat->id_transaksi_merk; ?></td>
                                        <td><?= $riwayat->tgl_jual; ?></td>
                                        <td><?= $riwayat->nama_pembeli; ?></td>
                                        <td><?= $riwayat->jumlah_jual; ?></td>
                                        <td><?= 'Rp. '.strrev(implode('.',str_split(strrev(strval($riwayat->potongan_harga)),3))); ?></td>
                                        <?php if ($riwayat->sisa_tagihan == 0) { ?>
                                            <td><?= 'Rp. '.strrev(implode('.',str_split(strrev(strval($riwayat->total_tagihan)),3))); ?> <span class="label label-success">Lunas</span></td>
                                        <?php } else { ?>
                                            <td><?= 'Rp. '.strrev(implode('.',str_split(strrev(strval($riwayat->total_tagihan)),3))); ?> <span class="label label-danger">Belum Lunas</span></td>
                                        <?php } ?>
                                        <td>
                                            <a href="<?php echo base_url('adminroot/PenjualanAdmin/detailRiwayatPenjualanMerkAdmin/'.$riwayat->id_transaksi_merk); ?>" class="btn btn-primary waves-effect">
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

<!-- Colored Card - With Loading -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Riwayat penjualan Merk oleh Kasir
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
                                <th>Nama Pembeli</th>
                                <th>Jumlah Jual</th>
                                <th>Potongan Harga</th>
                                <th>Total Belanja</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($riwayatTransaksiMerkKasir)) {
                                $no = 1;

                                foreach ($riwayatTransaksiMerkKasir as $riwayat) { ?>
                                    
                                    <tr>
                                        <th scope="row"><?= $no; ?></th>
                                        <td><?= $riwayat->id_transaksi_merk; ?></td>
                                        <td><?= $riwayat->tgl_jual; ?></td>
                                        <td><?= $riwayat->nama_pembeli; ?></td>
                                        <td><?= $riwayat->jumlah_jual; ?></td>
                                        <td><?= 'Rp. '.strrev(implode('.',str_split(strrev(strval($riwayat->potongan_harga)),3))); ?></td>
                                        <?php if ($riwayat->sisa_tagihan == 0) { ?>
                                            <td><?= 'Rp. '.strrev(implode('.',str_split(strrev(strval($riwayat->total_tagihan)),3))); ?> <span class="label label-success">Lunas</span></td>
                                        <?php } else { ?>
                                            <td><?= 'Rp. '.strrev(implode('.',str_split(strrev(strval($riwayat->total_tagihan)),3))); ?> <span class="label label-danger">Belum Lunas</span></td>
                                        <?php } ?>
                                        <td>
                                            <a href="<?php echo base_url('adminroot/PenjualanAdmin/detailRiwayatPenjualanMerkKasir/'.$riwayat->id_transaksi_merk); ?>" class="btn btn-primary waves-effect">
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