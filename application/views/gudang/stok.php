<?= showFlashMessage(); ?>

<!-- Exportable Table -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Daftar Stok Barang
                </h2>
            </div>
            <div class="body">
                <div class="table-responsive cs-table-xflow">
                    <table class="table table-bordered table-striped table-hover dataTable js-basic-example cs-data-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Barang</th>
                                <th>Jenis Sepatu</th>
                                <th>Ukuran</th>
                                <th>Warna</th>
                                <th>Jumlah Barang</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php 
                                if (!empty($stok)) {
                                    $no = 1;

                                    foreach ($stok as $stokBarang): ?>

                                    <tr>
                                        <th scope="row"><?= $no; ?></th>
                                        <td><?= $stokBarang->nama_merk; ?></td>
                                        <td><?= $stokBarang->jenis_sepatu; ?></td>
                                        <td><?= $stokBarang->ukuran; ?></td>
                                        <td><?= $stokBarang->warna; ?></td>
                                        <td><?= $stokBarang->stok; ?></td>
                                        <td>
                                            <button class="btn bg-light-blue waves-effect btn-detail" data-toggle="modal" data-target="#detailStokBarang" id="<?= $stokBarang->id_barang; ?>">
                                                <i class="material-icons">remove_red_eye</i>
                                                <span>Detail</span>
                                            </button>

                                            <button class="btn bg-light-green waves-effect btn-add" data-toggle="modal" data-target="#addBarangModal" id="<?= $stokBarang->id_barang; ?>">
                                                <i class="material-icons">add</i>
                                                <span>Tambah</span>
                                            </button>
                                        </td>   
                                    </tr>

                                    <?php $no++;
                                    endforeach;
                                } else { ?>
                                    <tr class="alert alert-danger">
                                        <td colspan="7" align="center" class="">Tidak ada Stok Barang di gudang</td>
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

<div class="modal fade" id="addBarangModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light-blue">
                <h4 class="modal-title" id="defaultModalLabel">Form Tambah Barang</h4>
            </div>
            <div class="modal-body">

                <form action="<?php echo base_url('gudang/stok/tambahBarang/'); ?>" id="form_advanced_validation" method="post">
                    <div class="form-group hidden-xs hidden-sm hidden-ls hidden-md hidden-lg">
                        <div class="form-line">
                            <input type="number" name="idBarangPost" id="idBarangPost">
                            <input type="number" name="stokLama" id="stokLama">
                            <input type="number" name="hargaSatuanPost" id="hargaSatuan">
                        </div>
                    </div>

                    <label>Vendor</label>
                    <div class="form-group">
                        <select class="form-control show-tick" name="vendorPost" data-live-search="true" required>
                            <optgroup label="Daftar Vendor">
                                <option value="">-- Pilih Vendor --</option>
                                <?php foreach ($vendor as $v) { ?>
                                    <option value="<?= $v->id_vendor ?>"><?= $v->nama_vendor; ?></option>
                                <?php } ?>
                            </optgroup>
                        </select>
                    </div>

                    <label>Jumlah Barang</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="number" name="jumlahPost" class="form-control" placeholder="Masukan Jumlah Barang" required min="1">
                        </div>
                    </div>
                    <br>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary waves-effect">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- modal process -->
<div class="modal fade" id="detailStokBarang" tabindex="-1" role="dialog" style="display: none;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light-blue">
                <h4 class="modal-title" id="defaultModalLabel">Pemesanan Pending</h4>
            </div>
            <div class="modal-body">
                <h3 id="namaBarang"></h3>

                <table class="table">
                    <thead>
                        <tr>
                            <th>Jenis Sepatu</th>
                            <th>Warna</th>
                            <th>Ukuran</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td id="jenisSepatu"></td>
                            <td id="warna"></td>
                            <td id="ukuran"></td>
                            <td id="stok"></td>
                        </tr>
                    </tbody>
                </table>

                <table class="table">
                    <thead>
                        <tr>
                            <th>Harga Beli</th>
                            <th>Harga Jual Konsumen</th>
                            <th>Harga Jual Reseller</th>
                            <th>Harga Packing</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td id="hargaBeli"></td>
                            <td id="hargaKonsumen"></td>
                            <td id="hargaReseller"></td>
                            <td id="hargaPacking"></td>
                        </tr>
                    </tbody>
                </table>
                            
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <label>Status Kepemilikan Barang</label>
                    <h4 id="kepemilikanBarang"></h4>
                </div>
            </div><br><br><br>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-primary waves-effect" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- End modal process -->

<script>
    $(".btn-detail").click(function() {
        console.log(this.id);
        var idBarang = this.id;
        $.post("<?= base_url('gudang/stok/detailStokBarang/'); ?>",
        {
            id: idBarang
        },

        function(data, status) {
            console.log("Data: " + data + "\nStatus: " + status);
            var data_objek = JSON.parse(data);

            document.getElementById("namaBarang").innerHTML = data_objek.detailBarang[0].nama_merk;
            document.getElementById("jenisSepatu").innerHTML = data_objek.detailBarang[0].jenis_sepatu;
            document.getElementById("warna").innerHTML = data_objek.detailBarang[0].warna;
            document.getElementById("ukuran").innerHTML = data_objek.detailBarang[0].ukuran;
            document.getElementById("stok").innerHTML = data_objek.detailBarang[0].stok;
            document.getElementById("hargaBeli").innerHTML = data_objek.detailBarang[0].harga;
            document.getElementById("hargaKonsumen").innerHTML = data_objek.detailBarang[0].harga_end_user;
            document.getElementById("hargaReseller").innerHTML = data_objek.detailBarang[0].harga_reseller;
            document.getElementById("hargaPacking").innerHTML = data_objek.detailBarang[0].harga_packing;
            document.getElementById("kepemilikanBarang").innerHTML = data_objek.detailBarang[0].kepemilikan_barang;
            
        });
    
    });

    $(".btn-add").click(function() {
        console.log(this.id);
        var idBarang = this.id;
        $.post("<?= base_url('gudang/stok/detailStokBarang/'); ?>",
        {
            id: idBarang
        },
        function(data, status) {
            //console.log("Data: " + data + "\nStatus: " + status);
            var data_objek = JSON.parse(data);
            
            $("#idBarangPost").val(data_objek.detailBarang[0].id_barang);
            $("#stokLama").val(data_objek.detailBarang[0].stok);
            $("#hargaSatuan").val(data_objek.detailBarang[0].harga);
        });
    });

</script>