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
                                    <strong>Email : </strong><label>EMAIL TOKO/ADMIN/PERUSAHAAN</label>
                                    <br />
                                    <strong>Call : </strong><label>NO. TELEPON TOKO/ADMIN/PERUSAHAAN</label>
                                </div>
                            </div>
                            <hr />

                            <p class="pull-left">#No. Transaksi : <?php echo $invoiceMerk[0]->id_transaksi_merk; ?></p>
                            <p class="pull-right">Kasir : <?= $invoiceMerk[0]->nama; ?></p>
                            <p style="clear: both;">Tanggal Pembelian : <?= $invoiceMerk[0]->tgl_jual; ?></p>

                            <div class="row">
                                <div class="col-lg-7 col-md-7 col-sm-7">
                                    <p class="h3">Client Details : </p>
                                    <p class="h5"><?= $invoiceMerk[0]->nama_pembeli; ?></p>
                                </div>
                            </div>
                            <hr />
            
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                  <strong>ITEM DESCRIPTION & DETAILS :</strong>
                                </div>
                            </div>

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
                                                <?php foreach ($invoiceMerk as $invMerk) {  ?>
                                                    <tr>
                                                        <td><?= $invMerk->nama_merk; ?></td>
                                                        <td><?= $invMerk->warna; ?></td>
                                                        <td><?= $invMerk->ukuran; ?></td>
                                                        <td><?= $invMerk->total_item; ?></td>
                                                        <td><?= 'Rp. '.strrev(implode('.',str_split(strrev(strval($invMerk->harga_jual_vendor)),3))); ?></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <hr>
                                    <div>
                                        <h4>  Total : Rp. <?= strrev(implode('.',str_split(strrev(strval($invoiceMerk[0]->total_tagihan)),3))); ?></h4>
                                        <h4>  Diskon : Rp. <?= strrev(implode('.',str_split(strrev(strval($invoiceMerk[0]->potongan_harga)),3))); ?></h4>
                                        <h4>  Uang Masuk : Rp. <?= strrev(implode('.',str_split(strrev(strval($invoiceMerk[0]->pembayaran_tagihan)),3))); ?></h4>
                                        <h4>  Uang Kembalian : Rp. <?= strrev(implode('.',str_split(strrev(strval($invoiceMerk[0]->uang_kembalian)),3))); ?></h4>
                                        <h4>  Sisa Pembayaran : Rp. <?= strrev(implode('.',str_split(strrev(strval($invoiceMerk[0]->sisa_tagihan)),3))); ?></h4>
                                    </div>
                                    <hr>
                                </div>
                            </div>
            
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <strong> Important: </strong>
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
                                    <?php if ($invoiceMerk[0]->referensi_1 == 0) { ?>
                                        <a href="<?= base_url('adminroot/PenjualanAdmin/cetakBuktiPembayaranMerkAdmin/'.$invoiceMerk[0]->id_transaksi_merk); ?>" title="Cetak Bukti Pembayaran" target="_blank" class="btn bg-light-green">
                                            <i class="material-icons">print</i>
                                            <span>Cetak</span>
                                        </a>
                                    <?php } else { ?>
                                        <a href="<?= base_url('adminroot/PenjualanAdmin/cetakBuktiPembayaranMerkKasir/'.$invoiceMerk[0]->id_transaksi_merk); ?>" title="Cetak Bukti Pembayaran" target="_blank" class="btn bg-light-green">
                                            <i class="material-icons">print</i>
                                            <span>Cetak</span>
                                        </a>
                                    <?php } ?>

                                    <a href="<?= base_url('adminroot/PenjualanAdmin/merk'); ?>" title="Kembali" class="btn bg-light-blue">
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
