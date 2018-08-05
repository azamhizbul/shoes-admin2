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
                    Riwayat penjualan oleh <?php echo $akun->nama; ?>
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
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php 
                                if (!empty($listpenjualan)) {
                                    $no = 1;

                                    foreach ($listpenjualan as $penjualan) { ?>

                                        <tr>
                                            <th scope="row"><?= $no; ?></th>
                                            <td><?= $penjualan->id_transaksi_end_user; ?></td>
                                            <td><?= $penjualan->tgl_jual; ?></td>
                                            <td><?= $penjualan->nama_pembeli; ?></td>
                                            <td><?= $penjualan->jumlah_jual; ?></td>
                                            <td><?= $penjualan->potongan_harga; ?></td>
                                            <td>
                                                <a href="<?= base_url('penjualan/penjualan/detailHistoryPenjualan/'.$penjualan->id_transaksi_end_user); ?>" class="btn btn-primary waves-effect btn-edit">
                                                    <i class="material-icons">remove_red_eye</i>
                                                </a>
												<a href="<?= base_url('penjualan/penjualan/cetakThermalEndUser/'.$penjualan->id_transaksi_end_user); ?>" class="btn bg-light-green waves-effect waves-light">
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

<!-- modal process -->
<div class="modal fade" id="defaultModal" tabindex="-1" role="dialog" style="display: none;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light-blue">
                <h4 class="modal-title" id="defaultModalLabel">Pembayaran</h4>
            </div>
            <div class="modal-body">
                <h4 id="namaPembeli"></h4>
                <p id="tglBeli"></p>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama Barang</th>
                            <th>Warna</th>
                            <th>Size</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td id="namaMerk"></td>
                            <td id="warna"></td>
                            <td id="ukuran"></td>
                            <td id="jumlah"></td>
                        </tr>
                    </tbody>
                </table>
                            
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <label>Jumlah Uang</label>
                    <h3 class="h3 cs-rm-margin-top" id="uangDiterima">Rp. </h3>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <label>Kembalian</label>
                    <h3 class="h3 cs-rm-margin-top" id="uangKembalian">Rp. </h3> 
                </div> 

                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <label>Total Pembelanjaan</label>
                    <h3 class="h3 cs-rm-margin-top" id="totalHarga">Rp. </h3>
                </div>  
            </div>
            <div class="modal-footer" style="margin-top: 51px">
                <button type="button" class="btn btn-primary waves-effect" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<!--End modal process -->
