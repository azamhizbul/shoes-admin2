 <!-- Colored Card - With Loading -->
 <div class="block-header">
    <h2>
        List pemesanan pending
    </h2>
</div>
<div class="row">
    <?php 
    if (!empty($listpesanan)) {
        
        foreach ($listpesanan as $pemesanan) { ?>
        
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="card">
                <div class="header bg-light-blue">
                    <h2>
                        <?= $pemesanan->nama_merk; ?> - <?= $pemesanan->warna; ?> <small><?= $pemesanan->total_beli; ?> pcs</small>
                    </h2>
                </div>
                <div class="body">
                    <label>Vendor : </label>
                    <label class="h5"><?= $pemesanan->nama_vendor; ?></label>
                    <br>
                    <label>Warna :  </label>
                    <label class="h5"><?= $pemesanan->warna; ?> </label>
                    <br>
                    <label>Size :  </label>
                    <label class="h5"><?= $pemesanan->ukuran; ?></label>
                </div>
                <div class="body">
                    <button class="btn btn-primary waves-effect btn-detail-pesanan-pending" id="<?= $pemesanan->id_transaksi_vendor; ?>" data-toggle="modal" data-target="#pesananPendingModal">
                        <i class="material-icons">remove_red_eye</i>
                        <span>Detail</span>
                    </button>
                </div>
            </div>
        </div>

    <?php }
    } else { ?>
        <h3 class="alert alert-danger">Tidak ada pesanan pending.</h3>
    <?php } ?>
    
</div>

<div class="block-header">
    <h2>Riwayat Pemesanan Barang</h2>
</div>

<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    List Riwayat Pemesanan
                </h2>
            </div>
            <div class="body">
                <div class="table-responsive cs-table-xflow">
                    <table class="table table-striped table-bordered dataTable table-hover js-basic-example cs-data-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Barang</th>
                                <th>Jumlah Barang</th>
                                <th>Total</th>
                                <th>Tanggal</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            if (!empty($riwayatpesanan)) {
                                $no = 1;
                                foreach ($riwayatpesanan as $riwayat) { ?>
                                            
                                    <tr>
                                        <th scope="row"><?= $no; ?></th>
                                        <td><?= $riwayat->produk; ?></td>
                                        <td><?= $riwayat->total_beli; ?></td>
                                        <td><?= $riwayat->total_harga_beli; ?></td>
                                        <td><?= $riwayat->tgl_beli; ?></td>
                                        <td>
                                            <button class="btn btn-primary waves-effect btn-detail-pesanan-sukses" id="<?= $riwayat->id_transaksi_vendor; ?>" data-toggle="modal" data-target="#pesananSuksesModal">
                                                <i class="material-icons">remove_red_eye</i>
                                                    <span>Detail</span>
                                            </button>
                                        </td>
                                    </tr>

                                <?php 
                                    $no++;
                                }
                            }  else { ?>
                                <tr class="alert alert-danger">
                                    <td colspan="6" align="center">Tidak ada riwayat pemesanan.</td>
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

<!-- modal process -->
<div class="modal fade" id="pesananPendingModal" tabindex="-1" role="dialog" style="display: none;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light-blue">
                <h4 class="modal-title" id="defaultModalLabel">Pemesanan Pending</h4>
            </div>
            <div class="modal-body">
                <h3 id="namaVendorPending"></h3>
                <h3 id="tglPesanPending"></h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama Barang</th>
                            <th>Warna</th>
                            <th>Ukuran</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td id="namaMerkPending"></td>
                            <td id="warnaPending"></td>
                            <td id="ukuranPending"></td>
                            <td id="totalItemPending"></td>
                        </tr>
                    </tbody>
                </table>
                            
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <label>Jumlah Uang Dibayarkan</label>
                    <h3 class="h3 cs-rm-margin-top" id="uangKeluarPending"></h3>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <label>Sisa Pembayaran</label>
                    <h3 class="h3 cs-rm-margin-top" id="sisaPembayaranPending"></h3> 
                </div> 

                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 cs-margin-bottom-20">
                    <label>Total Pembelanjaan</label>
                    <h3 class="h3 cs-rm-margin-top" id="totalBeliPending"></h3>
                </div> 

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="alert alert-danger">
                        <strong>Perhatian!</strong> reseller belum membayar penuh.
                    </div>
                </div>
            </div>
            
            <div class="modal-footer" style="margin-top: 151px">
                <button type="button" class="btn btn-primary waves-effect" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- modal process -->
<div class="modal fade" id="pesananSuksesModal" tabindex="-1" role="dialog" style="display: none;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light-blue">
                <h4 class="modal-title" id="defaultModalLabel">Pemesanan Sukses</h4>
            </div>
            <div class="modal-body">
                <h3 id="namaVendor"></h3>
                <h3 id="tglPesan"></h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama Barang</th>
                            <th>Warna</th>
                            <th>Ukuran</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td id="namaMerk"></td>
                            <td id="warna"></td>
                            <td id="ukuran"></td>
                            <td id="totalItem"></td>
                        </tr>
                    </tbody>
                </table>
                            
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <label>Jumlah Uang Dibayarkan</label>
                    <h3 class="h3 cs-rm-margin-top" id="uangKeluar"></h3>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <label>Sisa Pembayaran</label>
                    <h3 class="h3 cs-rm-margin-top" id="sisaPembayaran"></h3> 
                </div> 

                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 cs-margin-bottom-20">
                    <label>Total Pembelanjaan</label>
                    <h3 class="h3 cs-rm-margin-top" id="totalBeli"></h3>
                </div> 

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="alert alert-danger">
                        <strong>Perhatian!</strong> reseller belum membayar penuh.
                    </div>
                </div> 
            </div>
            
            <div class="modal-footer" style="margin-top: 151px">
                <button type="button" class="btn btn-primary waves-effect" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<!--End modal process -->

<script src="<?= base_url('assets/plugins/jquery/jquery.min.js'); ?>"></script>

<script>
    $(".btn-detail-pesanan-pending").click(function() {
        console.log(this.id);
        var idTransaksiVendor = this.id;
        $.post("<?= base_url('penjualan/pemesanan/detailHistoryPemesananPending'); ?>",
        {
            id: idTransaksiVendor
        },

        function(data, status) {
            console.log("Data: " + data + "\nStatus: " + status);
            var data_objek = JSON.parse(data);

            document.getElementById("namaVendorPending").innerHTML = data_objek.detailpemesanan[0].nama_vendor;
            document.getElementById('tglPesanPending').innerHTML = data_objek.detailpemesanan[0].tgl_beli;
            document.getElementById("namaMerkPending").innerHTML = data_objek.detailpemesanan[0].nama_merk;
            document.getElementById("warnaPending").innerHTML = data_objek.detailpemesanan[0].warna;
            document.getElementById("ukuranPending").innerHTML = data_objek.detailpemesanan[0].ukuran;
            document.getElementById("totalItemPending").innerHTML = data_objek.detailpemesanan[0].total_beli;
            document.getElementById('uangKeluarPending').innerHTML = data_objek.detailpemesanan[0].uang_keluar;
            document.getElementById("sisaPembayaranPending").innerHTML = data_objek.detailpemesanan[0].uang_kembalian;
            document.getElementById("totalBeliPending").innerHTML = data_objek.detailpemesanan[0].total_harga_beli;
            
            $('#modal_large').modal('toggle');
        });
    
    });

    $(".btn-detail-pesanan-sukses").click(function() {
        console.log(this.id);
        var idTransaksiVendorSukses = this.id;
        $.post("<?= base_url('penjualan/pemesanan/detailHistoryPemesananSukses'); ?>",
        {
            id: idTransaksiVendorSukses
        },

        function(data, status) {
            console.log("Data: " + data + "\nStatus: " + status);
            var data_objek = JSON.parse(data);

            document.getElementById("namaVendor").innerHTML = data_objek.detailpemesanan[0].nama_vendor;
            document.getElementById('tglPesan').innerHTML = data_objek.detailpemesanan[0].tgl_beli;
            document.getElementById("namaMerk").innerHTML = data_objek.detailpemesanan[0].nama_merk;
            document.getElementById("warna").innerHTML = data_objek.detailpemesanan[0].warna;
            document.getElementById("ukuran").innerHTML = data_objek.detailpemesanan[0].ukuran;
            document.getElementById("totalItem").innerHTML = data_objek.detailpemesanan[0].total_beli;
            document.getElementById("uangKeluar").innerHTML = data_objek.detailpemesanan[0].uang_keluar;
            document.getElementById("sisaPembayaran").innerHTML = data_objek.detailpemesanan[0].uang_kembalian;
            document.getElementById("totalBeli").innerHTML = data_objek.detailpemesanan[0].total_harga_beli;
            
            $('#modal_large').modal('toggle');
        });
    
    });

</script>  