 <!-- Colored Card - With Loading -->
            <div class="block-header">
                <h2>
                    Form Pemesanan Barang
                </h2>
            </div>

             <?= showFlashMessage(); ?>

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Input Pemesanan Barang
                            </h2>
                        </div>

                        <div class="body">
                                <label for="password">Nama Vendor</label>
                                <div class="form-group">
                                    <select class="form-control show-tick" id="vendor">
                                        <option value="">-- Pilih Vendor --</option>
                                       <?php 
                                        foreach ($vendor as $v) { ?>
                                            <option value="<?= $v->id_vendor; ?>"><?= $v->nama_vendor; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <label for="password">Nama Barang</label>
                                <div class="form-group">
                                    <select class="form-control show-tick" id="produk">
                                        <option value="">-- Pilih Barang --</option>
                                        <?php 
                                            foreach ($barang as $b) { ?>
                                                <option value="<?= $b->id_barang; ?>"><?= $b->produk; ?></option>    
                                            <?php }
                                         ?>
                                    </select>
                                </div>

                                <label for="email_address">Jumlah Barang</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="number" id="jumlah" class="form-control" placeholder="Masukan Jumlah Barang" >
                                    </div>
                                </div>

                                <div class="form-group">
                                    <input type="hidden" id="tglbeli" value="<?= date('Y-m-d'); ?>" />
                                </div>
                                
                                <div class="form-group cs-rm-margin-btn">
                                    <button class="btn btn-block btn-lg btn-primary waves-effect" data-toggle="modal" data-target="#defaultModal">
                                        <i class="material-icons">add</i>
                                        <span>Tambahkan</span> 
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Colored Card - With Loading -->

            <!-- modal process -->
            <div class="modal fade" id="defaultModal" tabindex="-1" role="dialog" style="display: none;">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-light-blue">
                            <h4 class="modal-title" id="defaultModalLabel">Pembayaran</h4>
                        </div>
                        <div class="modal-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th width="50%">Jumlah</th>
                                        <th>Total Pembelanjaan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><h3 class="h3" id="totalItem">200 /pasang</h3></dh>
                                        <td><h3 class="h3" id="totalHarga">Rp 2.000.000</h3></td>
                                    </tr>
                                </tbody>
                            </table>

                            <label for="email_address">Jumlah Uang</label>
                                <div class="form-group form-group-lg">
                                    <div class="form-line">
                                        <input type="number" id="uangKeluar" class="form-control" placeholder="Masukan Jumlah Uang">
                                    </div>
                                </div>

                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 pull-right">
                                    <label>Sisa Pembayaran</label>
                                    <br>
                                    <label class="h3" id="sisaPembayaran">Rp 10.000</label> 
                            </div>
                        </div>
                        <div class="modal-footer" style="margin-top: 51px">
                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
                            <a href="<?php echo base_url('penjualan/penjualan'); ?>" class="btn btn-primary waves-effect" >Print</a>
                        </div>
                    </div>
                </div>
            </div>
            <!--End modal process -->
