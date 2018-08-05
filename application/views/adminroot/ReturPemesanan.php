<?= showFlashMessage(); ?>
<!-- Exportable Table -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Daftar Retur Pemesanan Barang Pending
                </h2>
            </div>
            <div class="body">
                <div class="table-responsive cs-table-xflow">
                    <table class="table table-bordered table-striped table-hover dataTable js-basic-example cs-data-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Vendor</th>
                                <th>Nama Barang</th>
                                <th>Jumlah Retur</th>
                                <th>Tanggal Retur</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php 
                                if (!empty($returpending)) {
                                    $no = 1;

                                    foreach ($returpending as $retur): ?>

                                    <tr>
                                        <th scope="row"><?= $no; ?></th>
                                        <td><?= $retur->nama_vendor; ?></td>
                                        <td><?= $retur->produk; ?></td>
                                        <td><?= $retur->jumlah_retur_barang; ?></td>
                                        <td><?= $retur->tanggal_retur; ?></td>
                                        <td><?= $retur->keterangan; ?></td>
                                        <td>
                                            <button class="btn btn-primary waves-effect btn-detail" data-toggle="modal" data-target="#detailReturModal" id="<?= $retur->id_retur; ?>">
                                                <i class="material-icons">remove_red_eye</i>
                                                <span>Detail</span>
                                            </button>
                                            <button class="btn bg-light-green waves-effect btn-verifikasi-retur" id="<?= $retur->id_retur; ?>" data-toggle="modal" data-target="#verifikasiRetur">
                                                <i class="material-icons">remove_red_eye</i>
                                                <span>Verifikasi</span>
                                            </button>
                                        </td>
                                    </tr>
                                    
                                    <?php $no++;
                                    endforeach;
                                } else { ?>
                                    <tr class="alert alert-danger">
                                        <td colspan="7" align="center">Tidak ada retur barang di gudang</td>
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
                    Daftar Riwayat Retur Pemesanan Barang Sukses
                </h2>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover dataTable js-basic-example">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Vendor</th>
                                <th>Jumlah Retur</th>
                                <th>Tanggal Retur</th>
                                <th>Tanggal Selesai</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php 
                                if (!empty($retursukses)) {
                                    $no = 1;

                                    foreach ($retursukses as $riwayat): ?>

                                    <tr>
                                        <th scope="row"><?= $no; ?></th>
                                        <td><?= $riwayat->nama_vendor; ?></td>
                                        <td><?= $riwayat->jumlah_retur_barang; ?></td>
                                        <td><?= $riwayat->tanggal_retur; ?></td>
                                        <td><?= $riwayat->tanggal_selesai_retur; ?></td>
                                        <td><?= $riwayat->keterangan; ?></td>
                                        <td>
                                            <button class="btn btn-primary waves-effect btn-detail-riwayat-retur" data-toggle="modal" data-target="#detailRiwayatReturModal" id="<?= $riwayat->id_retur; ?>">
                                                <i class="material-icons">remove_red_eye</i>
                                                <span>Detail</span>
                                            </button>
                                        </td>
                                    </tr>
                                    
                                    <?php $no++;
                                    endforeach;
                                } else { ?>
                                    <tr class="alert alert-danger">
                                        <td colspan="7" align="center">Tidak ada riwayat retur barang di gudang</td>
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

<div class="modal fade" id="detailReturModal" tabindex="-1" role="dialog" style="display: none;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light-blue">
                <h4 class="modal-title" id="defaultModalLabel">Detil Retur Barang</h4>
            </div>
            <div class="modal-body">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 left">
                    <h3 class="h3 cs-rm-margin-top" id="namaVendor"></h3>
                    <h4 class="h4 cs-rm-margin-top" id="tglBeli"></h4>
                </div> 

                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 right">
                    <label>Tanggal Retur</label>
                    <h4 class="h4 cs-rm-margin-top" id="tglRetur"></h4> 
                </div>

                <table class="table">
                    <thead>
                        <tr>
                            <th>Merk</th>
                            <th>Warna</th>
                            <th>Ukuran</th>
                            <th>Jumlah Retur</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td id="merk"></td>
                            <td id="warna"></td>
                            <td id="ukuran"></td>
                            <td id="totalRetur"></td>
                        </tr>
                    </tbody>
                </table>

                <div class="body">
                    <label>Keterangan : </label>
                    <p id="keterangan"></p>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-primary waves-effect" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<!--End modal process -->

<div class="modal fade" id="detailRiwayatReturModal" tabindex="-1" role="dialog" style="display: none;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light-blue">
                <h4 class="modal-title" id="defaultModalLabel">Detil Riwayat Retur Barang</h4>
            </div>
            <div class="modal-body">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 left">
                    <h3 class="h3 cs-rm-margin-top" id="namaVendorRiwayat"></h3>
                    <h4 class="h4 cs-rm-margin-top" id="tglBeliRiwayat"></h4>
                </div> 

                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 center">
                    <label>Tanggal Retur</label>
                    <h4 class="h4 cs-rm-margin-top" id="tglReturRiwayat"></h4> 
                </div>

                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 right">
                    <label>Tanggal Selesai Retur</label>
                    <h4 class="h4 cs-rm-margin-top" id="tglSelesaiRiwayat"></h4> 
                </div>

                <table class="table">
                    <thead>
                        <tr>
                            <th>Merk</th>
                            <th>Warna</th>
                            <th>Ukuran</th>
                            <th>Jumlah Retur</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td id="merkRiwayat"></td>
                            <td id="warnaRiwayat"></td>
                            <td id="ukuranRiwayat"></td>
                            <td id="totalReturRiwayat"></td>
                        </tr>
                    </tbody>
                </table>

                <div class="body">
                    <label>Keterangan : </label>
                    <p id="keteranganRiwayat"></p>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="alert alert-success">
                        <strong>Perhatian!</strong> Proses retur pemesanan telah selesai.
                    </div>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-primary waves-effect" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal For Material Design Colors -->
<div class="modal fade" id="verifikasiRetur" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light-blue">
                <h4 class="modal-title" id="defaultModalLabel">Verifikasi Retur Barang</h4>
            </div>
            <div class="modal-body">
                <form id="form_advanced_validation" action="<?= base_url('adminroot/ReturPemesananAdmin/verifikasiRetur'); ?>" method="POST" accept-charset="utf-8">

                    <input type="hidden" name="idReturVerifikasi" id="idReturVerifikasi" />
                    <input type="hidden" name="tglSelesaiReturVerifikasi" value="<?= date('Y-m-d'); ?>" />
                    <input type="hidden" name="jumlahRetur" id="jumlahRetur">
                    <input type="hidden" name="stokLama" id="stokLama">
                    <input type="hidden" name="idBarangRetur" id="idBarangRetur">

                    <div class="pull-left">
                        <label>Tanggal Beli</label>
                        <h4 class="h4 cs-rm-margin-top" id="tglBeliVerifikasi"></h4>
                    </div>

                    <div class="pull-right">
                        <label>Tanggal Retur</label>
                        <h4 class="h4 cs-rm-margin-top" id="tglReturVerifikasi"></h4> 
                    </div>

                    <div style="clear: both;"></div>

                    <div class="form-group form-float">
                        <label class="form-label">Nama Vendor</label>
                        <div class="form-line">
                        <input type="text" class="form-control" name="namaVendorVerifikasi" id="namaVendorVerifikasi" readonly>                            
                        </div>
                    </div> 

                    <div class="form-group form-float">
                        <label class="form-label">Produk</label>
                        <div class="form-line">
                            <input type="text" class="form-control" name="produkVerifikasi" id="produkVerifikasi" readonly>     
                        </div>
                    </div>

                    <div class="form-group form-float">
                        <label class="form-label">Jumlah Retur</label>
                        <div class="form-line">
                            <input type="text" class="form-control" name="jumlahReturVerifikasi" id="jumlahReturVerifikasi" readonly>     
                        </div>
                    </div>

                    <!-- inputan keterangan barang retur -->
                    <div class="form-group form-float">
                        <div class="form-line">
                            <textarea name="keteranganVerifikasi" class="form-control" required></textarea>
                            <label class="form-label">Keterangan</label>
                        </div>
                        <div class="help-info">Masukkan keterangan untuk verifikasi retur pemesanan barang.</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn bg-light-blue waves-effect">Simpan</button>
                    <button type="button" class="btn bg-red waves-effect" data-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--End modal process -->

<script src="<?= base_url('assets/plugins/jquery/jquery.min.js'); ?>"></script>
<script>
    $(".btn-detail").click(function(){
        console.log(this.id);
        var idRetur = this.id;
        $.post("<?php echo base_url('adminroot/ReturPemesananAdmin/detailReturPemesananPending/') ?>",
        {
            id: idRetur
        },
        function(data, status){
            console.log("Data: " + data + "\nStatus: " + status);
            var data_objek = JSON.parse(data);

            document.getElementById('namaVendor').innerHTML = data_objek.retur[0].nama_vendor;
            document.getElementById('tglBeli').innerHTML = data_objek.retur[0].tgl_beli;
            document.getElementById('tglRetur').innerHTML = data_objek.retur[0].tanggal_retur;
            document.getElementById('merk').innerHTML = data_objek.retur[0].nama_merk;
            document.getElementById('warna').innerHTML = data_objek.retur[0].warna;
            document.getElementById('ukuran').innerHTML = data_objek.retur[0].ukuran;
            document.getElementById('totalRetur').innerHTML = data_objek.retur[0].jumlah_retur_barang;
            document.getElementById('keterangan').innerHTML = data_objek.retur[0].keterangan;
            
        });
    });

    $(".btn-detail-riwayat-retur").click(function(){
        console.log(this.id);
        var idRiwayatRetur = this.id;
        $.post("<?php echo base_url('adminroot/ReturPemesananAdmin/detailReturPemesananSukses/') ?>",
        {
            id: idRiwayatRetur
        },
        function(data, status){
            console.log("Data: " + data + "\nStatus: " + status);
            var data_objek = JSON.parse(data);

            document.getElementById('namaVendorRiwayat').innerHTML = data_objek.riwayatRetur[0].nama_vendor;
            document.getElementById('tglBeliRiwayat').innerHTML = data_objek.riwayatRetur[0].tgl_beli;
            document.getElementById('tglReturRiwayat').innerHTML = data_objek.riwayatRetur[0].tanggal_retur;
            document.getElementById('tglSelesaiRiwayat').innerHTML = data_objek.riwayatRetur[0].tanggal_selesai_retur;
            document.getElementById('merkRiwayat').innerHTML = data_objek.riwayatRetur[0].nama_merk;
            document.getElementById('warnaRiwayat').innerHTML = data_objek.riwayatRetur[0].warna;
            document.getElementById('ukuranRiwayat').innerHTML = data_objek.riwayatRetur[0].ukuran;
            document.getElementById('totalReturRiwayat').innerHTML = data_objek.riwayatRetur[0].jumlah_retur_barang;
            document.getElementById('keteranganRiwayat').innerHTML = data_objek.riwayatRetur[0].keterangan;
            
        });
    });

    $(".btn-verifikasi-retur").click(function(){
        console.log(this.id);
        var idVerifikasiRetur = this.id;
        $.post("<?php echo base_url('adminroot/ReturPemesananAdmin/detailReturPemesananPending/') ?>",
        {
            id: idVerifikasiRetur
        },
        function(data, status){
            console.log("Data: " + data + "\nStatus: " + status);
            var data_objek = JSON.parse(data);

            $("#idReturVerifikasi").val(data_objek.retur[0].id_retur);
            $("#jumlahRetur").val(data_objek.retur[0].jumlah_retur_barang);
            $("#stokLama").val(data_objek.retur[0].stok);
            $("#idBarangRetur").val(data_objek.retur[0].id_barang);
            
            document.getElementById('namaVendorVerifikasi').value = data_objek.retur[0].nama_vendor;
            document.getElementById('tglBeliVerifikasi').innerHTML = data_objek.retur[0].tgl_beli;
            document.getElementById('tglReturVerifikasi').innerHTML = data_objek.retur[0].tanggal_retur;
            document.getElementById('produkVerifikasi').value = data_objek.retur[0].produk;
            document.getElementById('jumlahReturVerifikasi').value = data_objek.retur[0].jumlah_retur_barang;
            
        });
    });

</script>