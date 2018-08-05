    <?= showFlashMessage(); ?>

    <!-- Colored Card - With Loading -->
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header bg-light-blue">
                    <h2>
                        NAMA TOKO/PERUSAHAAN
                    </h2>
                </div>
                <div class="body">
                    <div class="col-md-12 text-center"></div>
                    <div class="row color-invoice">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-lg-7 col-md-7 col-sm-7">
                                    <h1>BUKTI PEMBAYARAN</h1>
                                    <br />
                                    <strong>Email : </strong> <label>EMAIL TOKO/ADMIN/PERUSAHAAN</label>
                                    <br />
                                    <strong>Call : </strong> <label>NO. TELEPON TOKO/ADMIN/PERUSAHAAN</label>
                                </div>
                            </div>

                            <p class="pull-left">#No. Transaksi : <?= $detailpenjualan[0]->id_transaksi_end_user; ?></p>
                            <p class="pull-right">Kasir : <?= $detailpenjualan[0]->nama; ?></p>
                            <p style="clear: both;">Tanggal Pembelian : <?= $detailpenjualan[0]->tgl_jual; ?></p>
                            <hr />

                            <div class="row">
                                <div class="col-lg-7 col-md-7 col-sm-7">
                                    <h3>Client Details : </h3>
                                    <h5><?= $detailpenjualan[0]->nama_pembeli; ?> </h5>
                                </div>
                            </div>
                            <hr />
            
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                  <strong>ITEM DESCRIPTION & DETAILS :</strong>
                                </div>
                            </div>
                            <hr />

                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                  <th>Nama Barang</th>
                                                  <th>Warna</th>
                                                  <th>Ukuran</th>
                                                  <th>Jumlah</th>
                                                  <th>Harga /item</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($detailpenjualan as $invMerk) {  ?>
                                                    <tr>
                                                        <td><?= $invMerk->nama_merk; ?></td>
                                                        <td><?= $invMerk->warna; ?></td>
                                                        <td><?= $invMerk->ukuran; ?></td>
                                                        <td><?= $invMerk->total_item; ?></td>
                                                        <td><?= 'Rp. '.strrev(implode('.',str_split(strrev(strval($invMerk->harga_end_user)),3))); ?></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <hr>
                                    <div>
                                        <h4>  Total : Rp. <?= strrev(implode('.',str_split(strrev(strval($detailpenjualan[0]->harga_jual)),3))); ?></h4>
                                        <h4>  Diskon : Rp. <?= strrev(implode('.',str_split(strrev(strval($detailpenjualan[0]->potongan_harga)),3))); ?></h4>
                                        <h4>  Uang Pembayaran : Rp. <?= strrev(implode('.',str_split(strrev(strval($detailpenjualan[0]->uang_diterima)),3))); ?></h4>
                                        <h4>  Uang Kembalian : Rp. 
                                            <?php if ($detailpenjualan[0]->uang_kembalian < 0) { ?>
                                                0
                                            <?php } else { ?>
                                                <?= strrev(implode('.',str_split(strrev(strval($detailpenjualan[0]->uang_kembalian)),3))); ?>
                                            <?php } ?>
                                        </h4>
                                    </div>
                                    <hr>
                                </div>
                            </div>
            
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <strong>Catatan : </strong>
                                    <ol>
                                        <li>
                                            Simpan baik-baik bukti pembayaran ini untuk sebagai bukti pembelanjaan.
                                        </li>
                                        <li>
                                            Bukti pembayaran dijadikan bukti yang sah untuk tukar barang jika barang cacat.
                                        </li>
                                        <li>
                                            Tanpa adanya bukti pembayaran, pembeli tidak dapat tukar barang jika barang yang dibeli cacat!
                                        </li>
                                    </ol>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <a href="<?= base_url('penjualan/penjualan/cetakBuktiPembayaranEndUser/'.$detailpenjualan[0]->id_transaksi_end_user); ?>" title="Cetak Bukti Pembayaran" target="_blank" class="btn bg-light-green">
                                        <i class="material-icons">print</i>
                                        <span>Cetak</span>
                                    </a>
                                    <a href="<?= base_url('penjualan/penjualan/historyPenjualan/'); ?>" title="Kembali" class="btn bg-light-blue">
                                        <i class="material-icons">arrow_back</i>
                                        <span>Kembali</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Colored Card - With Loading -->
