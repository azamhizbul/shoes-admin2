<!-- Exportable Table -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Daftar Riwayat Tambah Stok Barang
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
                                <th>Jumlah</th>
                                <th>Karyawan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php 
                                if (!empty($riwayatTambah)) {
                                    $no = 1;

                                    foreach ($riwayatTambah as $riwayat): ?>

                                    <tr>
                                        <th scope="row"><?= $no; ?></th>
                                        <td><?= $riwayat->nama_vendor; ?></td>
                                        <td><?= $riwayat->tgl_beli; ?></td>
                                        <td><?= $riwayat->produk; ?></td>
                                        <td><?= $riwayat->total_beli; ?></td>
                                        <td><?= $riwayat->nama; ?></td>
                                        <td>
                                            <button class="btn bg-light-blue waves-effect btn-detail" data-toggle="modal" data-target="#detailRiwayatTambahStok" id="<?= $riwayat->id_transaksi_vendor; ?>">
                                                <i class="material-icons">remove_red_eye</i>
                                                <span>Detail</span>
                                            </button>
                                        </td>   
                                    </tr>

                                    <?php $no++;
                                    endforeach;
                                } else { ?>
                                    <tr class="alert alert-danger">
                                        <td colspan="7" align="center" class="">Tidak ada riwayat tambah Stok Barang di gudang</td>
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
<div class="modal fade" id="detailRiwayatTambahStok" tabindex="-1" role="dialog" style="display: none;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light-blue">
                <h4 class="modal-title" id="defaultModalLabel">Detil Riwayat Tambah Stok</h4>
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
<!-- End modal process -->

<script src="<?= base_url('assets/plugins/jquery/jquery.min.js'); ?>"></script>

<script>
    $(".btn-detail").click(function() {
        console.log(this.id);
        var idTransaksi = this.id;
        $.post("<?= base_url('gudang/stok/detailRiwayatTambahStokBarang/'); ?>",
        {
            id: idTransaksi
        },

        function(data, status) {
            console.log("Data: " + data + "\nStatus: " + status);
            var data_objek = JSON.parse(data);

            document.getElementById("namaVendor").innerHTML = data_objek.detailRiwayatBarang[0].nama_vendor;
            document.getElementById("tglBeli").innerHTML = data_objek.detailRiwayatBarang[0].tgl_beli;
            document.getElementById('namaKaryawan').innerHTML = data_objek.detailRiwayatBarang[0].nama;
            document.getElementById("namaMerk").innerHTML = data_objek.detailRiwayatBarang[0].nama_merk;
            document.getElementById("jenisSepatu").innerHTML = data_objek.detailRiwayatBarang[0].jenis_sepatu;
            document.getElementById("warna").innerHTML = data_objek.detailRiwayatBarang[0].warna;
            document.getElementById("ukuran").innerHTML = data_objek.detailRiwayatBarang[0].ukuran;
            document.getElementById("jumlah").innerHTML = data_objek.detailRiwayatBarang[0].total_beli;
            document.getElementById("kepemilikanBarang").innerHTML = data_objek.detailRiwayatBarang[0].kepemilikan_barang;
            
        });
    
    });

</script>