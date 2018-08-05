<!-- title container -->
<div class="block-header">
    <h2>Riwayat Tambah Stok Barang Pribadi</h2>
</div>
<!-- end title container -->

<!-- Colored Card - With Loading -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header cs-header-tambah-barang">
                <h2>
                    Daftar Riwayat Tambah Stok Barang Pribadi oleh Admin
                </h2>
            </div>

            <div class="body">
                <div class="table-responsive cs-table-xflow">
                    <table class="table table-bordered table-striped table-hover dataTable js-basic-example cs-data-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Vendor</th>
                                <th>Tanggal Penambahan</th>
                                <th>Produk</th>
                                <th>Jumlah Barang</th>
                                <th>Karyawan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php 
                                if (!empty($riwayatstokadmin)) {
                                    $no = 1;

                                    foreach ($riwayatstokadmin as $stok): ?>

                                    <tr>
                                        <th scope="row"><?= $no; ?></th>
                                        <td><?= $stok->nama_vendor; ?></td>
                                        <td><?= $stok->tgl_beli; ?></td>
                                        <td><?= $stok->produk; ?></td>
                                        <td><?= $stok->total_beli; ?></td>
                                        <td><?= $stok->nama; ?></td>
                                        <td>
                                            <button type="button" id="<?php echo $stok->id_transaksi_vendor; ?>" class="btn btn-sm btn-primary waves-effect btn-detail-admin" data-toggle="modal" data-target="#detailAdminModal">
                                                <i class="material-icons">remove_red_eye</i>
                                                <span>Detail</span>
                                            </button>
                                        </td>
                                    </tr>

                                    <?php $no++;
                                    endforeach;
                                } else { ?>
                                    <tr class="alert alert-danger">
                                        <td colspan="7" align="center">Tidak ada daftar riwayat tambah stok barang pribadi.</td>
                                    </tr>   
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header cs-header-tambah-barang">
                <h2>
                    Daftar Riwayat Tambah Stok Barang Pribadi oleh Gudang
                </h2>
            </div>

            <div class="body">
                <div class="table-responsive cs-table-xflow">
                    <table class="table table-bordered table-striped table-hover dataTable js-basic-example cs-data-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Vendor</th>
                                <th>Tanggal Penambahan</th>
                                <th>Produk</th>
                                <th>Jumlah Barang</th>
                                <th>Karyawan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php 
                                if (!empty($riwayatstokgudang)) {
                                    $no = 1;

                                    foreach ($riwayatstokgudang as $stok): ?>

                                    <tr>
                                        <th scope="row"><?= $no; ?></th>
                                        <td><?= $stok->nama_vendor; ?></td>
                                        <td><?= $stok->tgl_beli; ?></td>
                                        <td><?= $stok->produk; ?></td>
                                        <td><?= $stok->total_beli; ?></td>
                                        <td><?= $stok->nama; ?></td>
                                        <td>
                                            <button type="button" id="<?php echo $stok->id_transaksi_vendor; ?>" class="btn btn-sm btn-primary waves-effect btn-detail-gudang" data-toggle="modal" data-target="#detailGudangModal">
                                                <i class="material-icons">remove_red_eye</i>
                                                <span>Detail</span>
                                            </button>
                                        </td>
                                    </tr>

                                    <?php $no++;
                                    endforeach;
                                } else { ?>
                                    <tr class="alert alert-danger">
                                        <td colspan="7" align="center">Tidak ada daftar riwayat tambah stok barang pribadi.</td>
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
<div class="modal fade" id="detailAdminModal" tabindex="-1" role="dialog" style="display: none;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light-blue">
                <h4 class="modal-title" id="defaultModalLabel">Detil Riwayat Tambah Stok oleh Admin</h4>
            </div>
            <div class="modal-body">
                <h3 id="namaVendor"></h3>
                <p class="pull-left">Tanggal Transaksi : <label id="tglBeli" style="font-weight: normal;"></label></p>
                <p class="pull-right">Karyawan : <label id="namaKaryawan" style="font-weight: normal;"></label></p>
                
                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <th>Nama Merk</th>
                            <th>Jenis Sepatu</th>
                            <th>Warna</th>
                            <th>Ukuran</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td id="namaMerk"></td>
                            <td id="jenisSepatu"></td>
                            <td id="warna"></td>
                            <td id="ukuran"></td>
                            <td id="jumlah"></td>
                        </tr>
                    </tbody>
                </table>
                            
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <label>Status Kepemilikan Barang</label>
                    <h4 id="kepemilikanBarang"></h4>
                </div>
            </div><br><br>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-primary waves-effect" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="detailGudangModal" tabindex="-1" role="dialog" style="display: none;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light-blue">
                <h4 class="modal-title" id="defaultModalLabel">Detil Riwayat Tambah Stok oleh Gudang</h4>
            </div>
            <div class="modal-body">
                <h3 id="namaVendorGudang"></h3>
                <p class="pull-left">Tanggal Transaksi : <label id="tglBeliGudang" style="font-weight: normal;"></label></p>
                <p class="pull-right">Karyawan : <label id="namaKaryawanGudang" style="font-weight: normal;"></label></p>
                
                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <th>Nama Merk</th>
                            <th>Jenis Sepatu</th>
                            <th>Warna</th>
                            <th>Ukuran</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td id="namaMerkGudang"></td>
                            <td id="jenisSepatuGudang"></td>
                            <td id="warnaGudang"></td>
                            <td id="ukuranGudang"></td>
                            <td id="jumlahGudang"></td>
                        </tr>
                    </tbody>
                </table>
                            
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <label>Status Kepemilikan Barang</label>
                    <h4 id="kepemilikanBarangGudang"></h4>
                </div>
            </div><br><br>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-primary waves-effect" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<!-- End Modal Process -->

<!-- Jquery Core Js -->
<script src="<?php echo base_url('assets/plugins/jquery/jquery.min.js'); ?>"></script>

<script>
    
    $(".btn-detail-admin").click(function() {
        console.log(this.id);
        var idTransaksi = this.id;
        $.post("<?= base_url('adminroot/Pengelolaan_barang/detailRiwayatTambahStokAdmin/'); ?>",
        {
            id: idTransaksi
        },

        function(data, status) {
            console.log("Data: " + data + "\nStatus: " + status);
            var data_objek = JSON.parse(data);

            document.getElementById("namaVendor").innerHTML = data_objek.detailadmin[0].nama_vendor;
            document.getElementById("tglBeli").innerHTML = data_objek.detailadmin[0].tgl_beli;
            document.getElementById('namaKaryawan').innerHTML = data_objek.detailadmin[0].nama;
            document.getElementById("namaMerk").innerHTML = data_objek.detailadmin[0].nama_merk;
            document.getElementById("jenisSepatu").innerHTML = data_objek.detailadmin[0].jenis_sepatu;
            document.getElementById("warna").innerHTML = data_objek.detailadmin[0].warna;
            document.getElementById("ukuran").innerHTML = data_objek.detailadmin[0].ukuran;
            document.getElementById("jumlah").innerHTML = data_objek.detailadmin[0].total_beli;
            document.getElementById("kepemilikanBarang").innerHTML = data_objek.detailadmin[0].kepemilikan_barang;
            
        });
    
    });

    $(".btn-detail-gudang").click(function() {
        console.log(this.id);
        var idTransaksi = this.id;
        $.post("<?= base_url('adminroot/Pengelolaan_barang/detailRiwayatTambahStokGudang/'); ?>",
        {
            id: idTransaksi
        },

        function(data, status) {
            console.log("Data: " + data + "\nStatus: " + status);
            var data_objek = JSON.parse(data);

            document.getElementById("namaVendorGudang").innerHTML = data_objek.detailgudang[0].nama_vendor;
            document.getElementById("tglBeliGudang").innerHTML = data_objek.detailgudang[0].tgl_beli;
            document.getElementById('namaKaryawanGudang').innerHTML = data_objek.detailgudang[0].nama;
            document.getElementById("namaMerkGudang").innerHTML = data_objek.detailgudang[0].nama_merk;
            document.getElementById("jenisSepatuGudang").innerHTML = data_objek.detailgudang[0].jenis_sepatu;
            document.getElementById("warnaGudang").innerHTML = data_objek.detailgudang[0].warna;
            document.getElementById("ukuranGudang").innerHTML = data_objek.detailgudang[0].ukuran;
            document.getElementById("jumlahGudang").innerHTML = data_objek.detailgudang[0].total_beli;
            document.getElementById("kepemilikanBarangGudang").innerHTML = data_objek.detailgudang[0].kepemilikan_barang;
            
        });
    
    });

</script>
