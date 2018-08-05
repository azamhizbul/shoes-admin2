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
                    Riwayat penjualan reseller oleh <?php echo $akun->nama; ?>
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
                            <?php if (!empty($riwayatTransaksiMerk)) {
                                $no = 1;

                                foreach ($riwayatTransaksiMerk as $riwayat) { ?>
                                    
                                    <tr>
                                        <th scope="row"><?= $no; ?></th>
                                        <td><?= $riwayat->id_transaksi_merk; ?></td>
                                        <td><?= $riwayat->tgl_jual; ?></td>
                                        <td><?= $riwayat->nama_pembeli; ?></td>
                                        <td><?= $riwayat->jumlah_jual; ?></td>
                                        <td><?= $riwayat->potongan_harga; ?></td>
                                        <?php if ($riwayat->sisa_tagihan == 0) { ?>
                                            <td><?= $riwayat->total_tagihan; ?> <span class="label label-success">Lunas</span></td>
                                        <?php } else { ?>
                                            <td><?= $riwayat->total_tagihan; ?> <span class="label label-danger">Belum Lunas</span></td>
                                        <?php } ?>
                                        <td>
                                            <a href="<?php echo base_url('penjualan/penjualan/detailRiwayatPenjualanMerk/'.$riwayat->id_transaksi_merk); ?>" class="btn btn-primary waves-effect">
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