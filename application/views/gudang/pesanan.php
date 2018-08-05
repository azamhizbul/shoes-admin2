<div class="block-header">
    <h2>Riwayat Pemesanan Pending</h2>
</div>

<?= showFlashMessage(); ?>

<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    List Riwayat Pemesanan Pending
                </h2>
            </div>
            <div class="body">
                <div class="table-responsive cs-table-xflow">
                    <table class="table table-responsive table-striped table-bordered dataTable table-hover js-basic-example cs-data-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Barang</th>
                                <th>Jumlah Barang</th>
                                <th>Total</th>
                                <th>Tanggal</th>
                                <th>Pembayaran</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            if (!empty($listpemesanan)) {
                                $no = 1;
                                foreach ($listpemesanan as $pemesanan) { ?>
                                            
                                    <tr>
                                        <th scope="row"><?= $no; ?></th>
                                        <td><?= $pemesanan->produk; ?></td>
                                        <td><?= $pemesanan->total_beli; ?></td>
                                        <td><?= 'Rp. '.strrev(implode('.',str_split(strrev(strval($pemesanan->total_tagihan)),3))); ?></td>
                                        <td><?= $pemesanan->tgl_beli; ?></td>
                                        <td>
                                            <?php if ($pemesanan->sisa_tagihan != 0) { ?>
                                                <label class="h2 label label-danger">Belum Lunas</label>
                                            <?php } else { ?>
                                                 <label class="h2 label label-success">Lunas</label>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-primary waves-effect btn-detail-pesanan-pending" id="<?= $pemesanan->id_transaksi_vendor; ?>" data-toggle="modal" data-target="#pesananPendingModal" hidden="show">
                                                Detail
                                            </button>

                                            <button type="button" class="btn bg-light-green waves-effect btn-verifikasi" id="<?= $pemesanan->id_transaksi_vendor; ?>" data-toggle="modal" data-target="#verifikasiPesananModal" hidden="show">
                                                Verifikasi
                                            </button>                     
                                        </td>
                                    </tr>

                                <?php 
                                    $no++;
                                }
                            }  else { ?>
                                <tr class="alert alert-danger">
                                    <td colspan="7" align="center">Tidak ada riwayat pemesanan pending.</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>       
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
                    <table class="table table-responsive table-striped table-bordered dataTable table-hover js-basic-example cs-data-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Barang</th>
                                <th>Jumlah Barang</th>
                                <th>Total</th>
                                <th>Tanggal</th>
                                <th>Pembayaran</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            if (!empty($listpemesanansukses)) {
                                $no = 1;
                                foreach ($listpemesanansukses as $riwayat) { ?>
                                            
                                    <tr>
                                        <th scope="row"><?= $no; ?></th>
                                        <td><?= $riwayat->produk; ?></td>
                                        <td><?= $riwayat->total_beli; ?></td>
                                        <td><?= 'Rp. '.strrev(implode('.',str_split(strrev(strval($riwayat->total_tagihan)),3))); ?></td>
                                        <td><?= $riwayat->tgl_beli; ?></td>
                                        <td>
                                            <?php if ($riwayat->sisa_tagihan != 0) { ?>
                                                <label class="h2 label label-danger">Belum Lunas</label>
                                            <?php } else { ?>
                                                 <label class="h2 label label-success">Lunas</label>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <button class="btn btn-primary waves-effect btn-detail-pesanan-sukses" id="<?= $riwayat->id_transaksi_vendor; ?>" data-toggle="modal" data-target="#pesananSuksesModal">
                                                Detail
                                            </button>

                                            <button type="button" data-color="light-blue" id="<?= $riwayat->id_transaksi_vendor; ?>" title="Retur" class="btn bg-red waves-effect btn-retur" data-toggle="modal" data-target="#returModal" >
                                                Retur
                                            </button>
                                        </td>
                                    </tr>

                                <?php 
                                    $no++;
                                }
                            }  else { ?>
                                <tr class="alert alert-danger">
                                    <td colspan="8" align="center">Tidak ada riwayat pemesanan.</td>
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
                <p class="pull-left">Tanggal Pemesanan : <label id="tglPesanPending"></label></p>
                <p class="pull-right">Karyawan : <label id="namaKaryawanPending"></label></p>
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
                    <label>Total Pembelanjaan</label>
                    <h3 class="h3 cs-rm-margin-top" id="totalBeliPending"></h3>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <label>Jumlah Uang Dibayarkan</label>
                    <h3 class="h3 cs-rm-margin-top" id="uangKeluarPending"></h3>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <label>Sisa Pembayaran</label>
                    <h3 class="h3 cs-rm-margin-top" id="sisaPembayaranPending"></h3> 
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
                <p class="pull-left">Tanggal Pemesanan : <label id="tglPesan"></label></p>
                <p class="pull-right">Karyawan : <label id="namaKaryawan"></label></p>
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
                    <label>Total Pembelanjaan</label>
                    <h3 class="h3 cs-rm-margin-top" id="totalBeli"></h3>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <label>Jumlah Uang Dibayarkan</label>
                    <h3 class="h3 cs-rm-margin-top" id="uangKeluar"></h3>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <label>Sisa Pembayaran</label>
                    <h3 class="h3 cs-rm-margin-top" id="sisaPembayaran"></h3> 
                </div> 

                
            </div>
            
            <div class="modal-footer" style="margin-top: 151px">
                <button type="button" class="btn btn-primary waves-effect" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal For Material Design Colors -->
<div class="modal fade" id="returModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light-blue">
                <h4 class="modal-title" id="defaultModalLabel">Form Retur Barang</h4>
            </div>
            <div class="modal-body">
                
                <form id="insertReturPemesanan" action="<?= base_url('gudang/pesanan/tambahReturBarang'); ?>" method="POST" accept-charset="utf-8">
                    <input type="hidden" name="idTransaksi" id="idTransaksi" />
                    <input type="hidden" name="tglBeli" id="tglBeli" />
                    <input type="hidden" name="idBarang" id="idBarang" />
                    <input type="hidden" name="tglRetur" value="<?= date('Y-m-d'); ?>" />
                    <input type="hidden" name="stokLamaRetur" id="stokLamaRetur" />

                    <!-- Inputan vendor -->
                    <div class="form-group form-float">
                        <label class="form-label">Nama Vendor</label>
                        <div class="form-line">
                            <input type="text" class="form-control" id="namaVendorRetur" readonly>
                        </div>
                    </div>

                    <div class="form-group form-float">
                        <label class="form-label">Produk</label>
                        <div class="form-line">
                            <input type="text" class="form-control" id="namaProdukRetur" readonly>
                        </div>
                    </div>
                        
                    <!-- Inputan jumlah barang retur -->
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="number" class="form-control" name="jumlahRetur" id="jumlahRetur" min="1" required>
                            <label class="form-label">Jumlah Barang Retur</label>
                        </div>
                        <div class="help-info">Min. 1, max. <label id="maxRetur"></label></div>
                    </div>

                    <!-- inputan keterangan barang retur -->
                    <div class="form-group form-float">
                        <div class="form-line">
                            <textarea name="keterangan" class="form-control" required></textarea>
                            <label class="form-label">Keterangan</label>
                        </div>
                        <div class="help-info">Keterangan</div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary waves-effect"> <i class="material-icons">check_circle</i><span>Simpan</span></button>
                        <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal"><i class="material-icons">close</i><span>Batal</span></button>
                    </div>
                </form>
            </div> 
        </div>
    </div>
</div>

<!-- Modal For Material Design Colors -->
<div class="modal fade" id="verifikasiPesananModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light-blue">
                <h4 class="modal-title" id="defaultModalLabel">Verifikasi Pesanan</h4>
            </div>
            <div class="modal-body">
                Apakah barang pesanan telah dicek sesuai data dari pemesanan barang?
            </div>
            <div class="modal-footer">
                <form action="<?= base_url('gudang/pesanan/verifikasiPemesanan'); ?>" method="POST" accept-charset="utf-8">
                    
                    <input type="hidden" name="idPemesananVendor" id="idPemesananVendor" placeholder="Id transaksi vendor" />
                    <input type="hidden" name="idBarangPemesananVendor" id="idBarangPemesananVendor" placeholder="id barang" />
                    <input type="hidden" name="stoklama" id="stoklama" placeholder="stok lama" />
                    <input type="hidden" name="totalbeli" id="totalBeliPemesanan" placeholder="total beli pemesanan" />
                
                    <button type="submit" class="btn btn-primary waves-effect">
                        <i class="material-icons">check_circle</i>
                        <span>OK</span>
                    </button>
                    
                    <button type="button" class="btn waves-effect" data-dismiss="modal">
                        <i class="material-icons">close</i>
                        <span>Batal</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<!--End of Modal process -->

<script>

    // Validation form
    $('#insertReturPemesanan').validate();

    $(".btn-detail-pesanan-pending").click(function() {
        console.log(this.id);
        var idTransaksiVendor = this.id;
        $.post("<?= base_url('gudang/pesanan/detailRiwayatPemesananPending/'); ?>",
        {
            id: idTransaksiVendor
        },

        function(data, status) {
            console.log("Data: " + data + "\nStatus: " + status);
            var data_objek = JSON.parse(data);

            var rupiahuangkeluar = '';        
            var angkauangkeluar = data_objek.detailpemesanan[0].pembayaran_tagihan.toString().split('').reverse().join('');
            for(var i = 0; i < angkauangkeluar.length; i++) if(i%3 == 0) rupiahuangkeluar += angkauangkeluar.substr(i,3)+'.';

            var rupiahuangkembalian = '';        
            var angkauangkembalian = data_objek.detailpemesanan[0].sisa_tagihan.toString().split('').reverse().join('');
            for(var i = 0; i < angkauangkembalian.length; i++) if(i%3 == 0) rupiahuangkembalian += angkauangkembalian.substr(i,3)+'.';

            var rupiahtotalbeli = '';        
            var angkatotalbeli = data_objek.detailpemesanan[0].total_tagihan.toString().split('').reverse().join('');
            for(var i = 0; i < angkatotalbeli.length; i++) if(i%3 == 0) rupiahtotalbeli += angkatotalbeli.substr(i,3)+'.';

            document.getElementById("namaVendorPending").innerHTML = data_objek.detailpemesanan[0].nama_vendor;
            document.getElementById('tglPesanPending').innerHTML = data_objek.detailpemesanan[0].tgl_beli;
            document.getElementById('namaKaryawanPending').innerHTML = data_objek.detailpemesanan[0].nama;
            document.getElementById("namaMerkPending").innerHTML = data_objek.detailpemesanan[0].nama_merk;
            document.getElementById("warnaPending").innerHTML = data_objek.detailpemesanan[0].warna;
            document.getElementById("ukuranPending").innerHTML = data_objek.detailpemesanan[0].ukuran;
            document.getElementById("totalItemPending").innerHTML = data_objek.detailpemesanan[0].total_beli;
            document.getElementById('uangKeluarPending').innerHTML = 'Rp. '+rupiahuangkeluar.split('', rupiahuangkeluar.length-1).reverse().join('');
            document.getElementById('sisaPembayaranPending').innerHTML = 'Rp. '+rupiahuangkembalian.split('', rupiahuangkembalian.length-1).reverse().join('');
            document.getElementById('totalBeliPending').innerHTML = 'Rp. '+rupiahtotalbeli.split('', rupiahtotalbeli.length-1).reverse().join('');
        });
    
    });

    $(".btn-detail-pesanan-sukses").click(function() {
        console.log(this.id);
        var idTransaksiVendorSukses = this.id;
        $.post("<?= base_url('gudang/pesanan/detailRiwayatPemesananSukses/'); ?>",
        {
            id: idTransaksiVendorSukses
        },

        function(data, status) {
            console.log("Data: " + data + "\nStatus: " + status);
            var data_objek = JSON.parse(data);

            var rupiahuangkeluar = '';        
            var angkauangkeluar = data_objek.detailpemesanan[0].pembayaran_tagihan.toString().split('').reverse().join('');
            for(var i = 0; i < angkauangkeluar.length; i++) if(i%3 == 0) rupiahuangkeluar += angkauangkeluar.substr(i,3)+'.';

            var rupiahuangkembalian = '';        
            var angkauangkembalian = data_objek.detailpemesanan[0].sisa_tagihan.toString().split('').reverse().join('');
            for(var i = 0; i < angkauangkembalian.length; i++) if(i%3 == 0) rupiahuangkembalian += angkauangkembalian.substr(i,3)+'.';

            var rupiahtotalbeli = '';        
            var angkatotalbeli = data_objek.detailpemesanan[0].total_tagihan.toString().split('').reverse().join('');
            for(var i = 0; i < angkatotalbeli.length; i++) if(i%3 == 0) rupiahtotalbeli += angkatotalbeli.substr(i,3)+'.';

            document.getElementById("namaVendor").innerHTML = data_objek.detailpemesanan[0].nama_vendor;
            document.getElementById('tglPesan').innerHTML = data_objek.detailpemesanan[0].tgl_beli;
            document.getElementById('namaKaryawan').innerHTML = data_objek.detailpemesanan[0].nama;
            document.getElementById("namaMerk").innerHTML = data_objek.detailpemesanan[0].nama_merk;
            document.getElementById("warna").innerHTML = data_objek.detailpemesanan[0].warna;
            document.getElementById("ukuran").innerHTML = data_objek.detailpemesanan[0].ukuran;
            document.getElementById("totalItem").innerHTML = data_objek.detailpemesanan[0].total_beli;
            document.getElementById('uangKeluar').innerHTML = 'Rp. '+rupiahuangkeluar.split('', rupiahuangkeluar.length-1).reverse().join('');
            document.getElementById('sisaPembayaran').innerHTML = 'Rp. '+rupiahuangkembalian.split('', rupiahuangkembalian.length-1).reverse().join('');
            document.getElementById('totalBeli').innerHTML = 'Rp. '+rupiahtotalbeli.split('', rupiahtotalbeli.length-1).reverse().join('');

            $('#modal_large').modal('toggle');
        });
    
    });

    $(".btn-verifikasi").click(function() {
        console.log(this.id);
        var idTransaksiVerifikasi = this.id;
        $.post("<?= base_url('gudang/pesanan/detailRiwayatPemesananPending/') ?>",
        {
            id: idTransaksiVerifikasi
        },
        function(data, status) {
            console.log("Data: " + data + "\nStatus: ");
            var data_objek = JSON.parse(data);

            document.getElementById('idPemesananVendor').value = data_objek.detailpemesanan[0].id_transaksi_vendor;
            document.getElementById('idBarangPemesananVendor').value = data_objek.detailpemesanan[0].id_barang;
            document.getElementById('stoklama').value = data_objek.detailpemesanan[0].stok;
            document.getElementById('totalBeliPemesanan').value = data_objek.detailpemesanan[0].total_beli;

        });
    });

    // get fine One Update
    $(".btn-retur").click(function(){
        console.log(this.id);
        var idTransaksiVendor = this.id;
        $.post("<?php echo base_url('gudang/pesanan/pemesananRetur/') ?>",
        {
            id: idTransaksiVendor
        },
        function(data, status){
            console.log("Data: " + data + "\nStatus: " + status);
            var data_objek = JSON.parse(data);

            document.getElementById('jumlahRetur').setAttribute("max", data_objek.pemesanan[0].total_beli);
            document.getElementById('maxRetur').innerHTML = data_objek.pemesanan[0].total_beli;
            $("#idTransaksi").val(data_objek.pemesanan[0].id_transaksi_vendor);
            $("#idVendor").val(data_objek.pemesanan[0].id_vendor);
            $("#tglBeli").val(data_objek.pemesanan[0].tgl_beli);
            $("#idBarang").val(data_objek.pemesanan[0].id_barang);
            $("#stokLamaRetur").val(data_objek.pemesanan[0].stok);
            $("#namaVendorRetur").val(data_objek.pemesanan[0].nama_vendor);
            $("#namaProdukRetur").val(data_objek.pemesanan[0].produk);
        });
    });

</script> 