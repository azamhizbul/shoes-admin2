<!-- title container -->
<div class="block-header">
    <h2>Pengeluaran Bulanan</h2>
</div>
<!-- end title container -->

 <!-- Colored Card - With Loading -->
       <!-- Colored Card - With Loading -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    <b>Riwayat Pengeluaran</b>
                </h2>
            </div>

            <div class="body">
                <div class="table-responsive cs-table-xflow">
                    <table class="table table-bordered table-striped table-hover dataTable js-basic-example cs-data-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tanggal</th>
                                <th>Bulan</th>
                                <th>Tahun</th>
                                <th>Total</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php 
                                if (!empty($laporanPengeluaranPerBulan)) {
                                    $no = 1;

                                    foreach ($laporanPengeluaranPerBulan as $data): ?>

                                    <tr>
                                        <th scope="row"><?= $no; ?></th>
                                        <td><?= $data->Tanggal; ?></td>
                                        <td><?= $data->Bulan; ?></td>
                                        <td><?= $data->Tahun; ?></td>
                                        <td><?= 'Rp. '.strrev(implode('.',str_split(strrev(strval($data->Total)),3))); ?></td>
                                        <td>
                                            <center>
                                                <button class="btn btn-primary waves-effect btn-detail" data-toggle="modal" data-target="#defaultModal" id="<?= $data->Tanggal; ?>">
                                                    <i class="material-icons">remove_red_eye</i>
                                                    <span>Detail</span>
                                                </button>
                                            </center>
                                        </td>
                                    </tr>
                                    <?php $no++;
                                    endforeach;
                                } else { ?>
                                    <tr class="alert alert-danger">
                                        <td colspan="9" align="center">Tidak ada daftar laporan.</td>
                                    </tr>   
                            <?php } ?>
                        </tbody>
                    </table>
                </div>


                <?php if (!empty($laporanPengeluaranPerBulan)) { ?>
                    <a href="<?= base_url('adminroot/laporan_pengeluaran/printLaporanBulanan/'.$laporanPengeluaranPerBulan[0]->Bln."/".$laporanPengeluaranPerBulan[0]->Tahun); ?>" title="Cetak Laporan" class="btn bg-light-green" target="_blank">
                        <i class="material-icons">print</i>
                        <span>Cetak</span>
                    </a>

                    <a href="<?= base_url('adminroot/laporan_pengeluaran/') ?>" title="Kembali" class="btn bg-blue">
                        <i class="material-icons">keyboard_return</i>
                        <span>Kembali</span>
                    </a>
                <?php } else { ?>
                    <a href="<?= base_url('adminroot/laporan_pengeluaran/') ?>" title="Kembali" class="btn bg-blue">
                        <i class="material-icons">keyboard_return</i>
                        <span>Kembali</span>
                    </a>
                <?php } ?>

            </div>                        
        </div>
    </div>
</div>


<div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light-blue">
                <h4 class="modal-title" id="defaultModalLabel">Detail Pengeluaran Bulanan</h4>
            </div>
            <div class="modal-body">

                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 left">
                    <label>Tanggal Pengeluaran</label>
                    <h4 class="h4 cs-rm-margin-top" id="tglPengeluaran"></h4> 
                    <br>
                </div>

                <table class="table ">
                    <thead>
                        <tr>
                            <th>Jumlah Pengeluaran Karyawan</th>
                            <th>Jumlah Pengeluaran Kantor</th>
                            <th>Jumlah Pembelian Ke Vendor</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td id="karyawan"></td>
                            <td id="kantor"></td>
                            <td id="vendor"></td>
                            <td id="total"></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-primary waves-effect" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Jquery Core Js -->
    <script src="<?php echo base_url('assets/plugins/jquery/jquery.min.js'); ?>"></script> 

<script>
    $(".btn-detail").click(function(){
        console.log(this.id);
        var tanggalPengeluaran = this.id;
        $.post("<?php echo base_url('adminroot/LaporanPengeluaranBulanan/getTanggalPengeluaranBulanan/') ?>",
    {
        id: tanggalPengeluaran
    },
        function(data, status){
            console.log("Data: " + data + "\nStatus: " + status);
            var data_objek = JSON.parse(data);

            var rupiahkantor = '';        
            var angkakantor = data_objek.pengeluaran[0].total_pengeluaran_kantor.toString().split('').reverse().join('');
            for(var i = 0; i < angkakantor.length; i++) if(i%3 == 0) rupiahkantor += angkakantor.substr(i,3)+'.';

            var rupiahkaryawan = '';
            var angkakaryawan = data_objek.pengeluaran[0].total_pengeluaran_karyawan.toString().split('').reverse().join('');
            for(var i = 0; i < angkakaryawan.length; i++) if(i%3 == 0) rupiahkaryawan += angkakaryawan.substr(i,3)+'.';

            var rupiahvendor = '';
            var angkavendor = data_objek.pengeluaran[0].total_transaksi_vendor.toString().split('').reverse().join('');
            for(var i = 0; i < angkavendor.length; i++) if(i%3 == 0) rupiahvendor += angkavendor.substr(i,3)+'.';

            var total = parseInt(data_objek.pengeluaran[0].total_transaksi_vendor) + parseInt(data_objek.pengeluaran[0].total_pengeluaran_kantor) + parseInt(data_objek.pengeluaran[0].total_pengeluaran_karyawan);
            var rupiahtotal = '';
            var angkatotal = total.toString().split('').reverse().join('');
            for(var i = 0; i < angkatotal.length; i++) if(i%3 == 0) rupiahtotal += angkatotal.substr(i,3)+'.';

            document.getElementById('tglPengeluaran').innerHTML = tanggalPengeluaran;
            document.getElementById('karyawan').innerHTML = 'Rp. '+rupiahkaryawan.split('',rupiahkaryawan.length-1).reverse().join('');
            document.getElementById('kantor').innerHTML = 'Rp. '+rupiahkantor.split('',rupiahkantor.length-1).reverse().join('');
            document.getElementById('vendor').innerHTML = 'Rp. '+rupiahvendor.split('',rupiahvendor.length-1).reverse().join('');
            document.getElementById('total').innerHTML = 'Rp. '+rupiahtotal.split('',rupiahtotal.length-1).reverse().join('');
            
            $('#modal_large').modal('toggle');
        });
    });
</script>
            <!-- #END# Colored Card - With Loading -->

 