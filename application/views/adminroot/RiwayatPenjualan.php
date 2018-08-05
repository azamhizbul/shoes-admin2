 <!-- Colored Card - With Loading -->
<div class="block-header">
    <h2>
        Riwayat Penjualan
    </h2>
</div>

<!-- Exportable Table -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Riwayat penjualan oleh admin
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
                                <th>Kasir</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php 
                                if (!empty($listpenjualanadmin)) {
                                    $no = 1;

                                    foreach ($listpenjualanadmin as $penjualan) { ?>

                                        <tr>
                                            <th scope="row"><?= $no; ?></th>
                                            <td><?= $penjualan->id_transaksi_end_user; ?></td>
                                            <td><?= $penjualan->tgl_jual; ?></td>
                                            <td><?= $penjualan->nama_pembeli; ?></td>
                                            <td><?= $penjualan->jumlah_jual; ?></td>
                                            <td><?= 'Rp. '.strrev(implode('.',str_split(strrev(strval($penjualan->potongan_harga)),3))); ?></td>
                                            <td><?= $penjualan->nama; ?></td>
                                            <td>
                                                <a href="<?= base_url('adminroot/PenjualanAdmin/detailHistoryPenjualanAdmin/'.$penjualan->id_transaksi_end_user); ?>" class="btn btn-primary waves-effect btn-edit">
                                                    <i class="material-icons">remove_red_eye</i>
                                                </a>
												<a href="<?= base_url('adminroot/PenjualanAdmin/cetakThermalEndUserAdmin/'.$penjualan->id_transaksi_end_user); ?>" class="btn bg-light-green waves-effect waves-light">
													<i class="material-icons">print</i>
												</a>
                                            </td>
                                        </tr>

                                    <?php $no++;
                                    }
                                } else { ?>
                                    <tr class="alert alert-danger">
                                        <td colspan="8" align="center">Tidak ada riwayat penjualan</td>
                                    </tr>
                                <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- #END# Exportable Table -->

<!-- Exportable Table -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Riwayat penjualan oleh kasir
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
                                <th>Kasir</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php 
                                if (!empty($listpenjualankasir)) {
                                    $no = 1;

                                    foreach ($listpenjualankasir as $penjualan) { ?>

                                        <tr>
                                            <th scope="row"><?= $no; ?></th>
                                            <td><?= $penjualan->id_transaksi_end_user; ?></td>
                                            <td><?= $penjualan->tgl_jual; ?></td>
                                            <td><?= $penjualan->nama_pembeli; ?></td>
                                            <td><?= $penjualan->jumlah_jual; ?></td>
                                            <td><?= 'Rp. '.strrev(implode('.',str_split(strrev(strval($penjualan->potongan_harga)),3))); ?></td>
                                            <td><?= $penjualan->nama; ?></td>
                                            <td>
                                                <a href="<?= base_url('adminroot/PenjualanAdmin/detailHistoryPenjualanKasir/'.$penjualan->id_transaksi_end_user); ?>" class="btn btn-primary waves-effect btn-edit">
                                                    <i class="material-icons">remove_red_eye</i>
                                                </a>
												<a href="<?= base_url('adminroot/PenjualanAdmin/cetakThermalEndUserKasir/'.$penjualan->id_transaksi_end_user); ?>" class="btn bg-light-green waves-light waves-effect">
													<i class="material-icons">print</i>
												</a>
                                            </td>
                                        </tr>

                                    <?php $no++;
                                    }
                                } else { ?>
                                    <tr class="alert alert-danger">
                                        <td colspan="8" align="center">Tidak ada riwayat penjualan</td>
                                    </tr>
                                <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- #END# Exportable Table -->
