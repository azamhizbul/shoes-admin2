    <!-- title container -->
<div class="block-header">
    <h2>Invoice</h2>
</div>
<!-- end title container -->

<!-- Colored Card - With Loading -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header cs-header-tambah-barang">
                <h2>
                    Daftar Invoice Reseller
                </h2>
                <!-- <button type="button" class="btn btn-sm btn-primary waves-effect cs-btn-tambah-barang-r" data-toggle="modal" data-target="#defaultModalPost">
                    <i class="material-icons">add</i>
                    <span>Tambah Invoice</span>
                </button> -->
            </div>

            <div class="body">
                <div class="table-responsive cs-table-xflow">
                    <table id="dataInvoice" class="table table-bordered table-striped table-hover dataTable js-basic-example cs-data-table" style="width: 100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Invoice</th>
                                <th>Nama Reseller</th>
                                <th>Tanggal Transaksi</th>
                                <th>Jumlah Transaksi</th>
                                <th>Total Pembayaran</th>
                                <th>Sisa Pembayaran</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php 
                                if (!empty($invoiceReseller)) {
                                    $no = 1;
                                    $param;
                                    foreach ($invoiceReseller as $invoice):
                                        $param = 'res'.'.'.$invoice->id?>

                                    <tr>
                                        <th scope="row"><?= $no; ?></th>
                                        <td style="width=20%"><?= $invoice->id; ?></td>
                                        <td><?= $invoice->nama_reseller; ?></td>
                                        <td><?= $invoice->tgl_transaksi; ?></td>
                                        <td><?= 'Rp. '.strrev(implode('.',str_split(strrev(strval($invoice->jumlah_transaksi)),3))); ?></td>
                                        <td><?= 'Rp. '.strrev(implode('.',str_split(strrev(strval($invoice->total_pembayaran)),3))); ?></td>
                                        <td><?= 'Rp. '.strrev(implode('.',str_split(strrev(strval($invoice->total_tagihan)),3))); ?></td>
                                        <td><?= $invoice->status_invoice; ?></td>
                                        <td>
                                            <a type="button" class="btn btn-sm bg-light-blue waves-effect btn-detail-reseller" href="<?php echo base_url('adminroot/DetailInvoice/detailInvoice/').$param; ?>">
                                                <i class="material-icons">remove_red_eye</i>
                                            </a>
                                            <button type="button" class="btn btn-sm bg-light-green waves-effect btn-lunasi-reseller" id="<?php echo $invoice->id ?>"  data-toggle="modal" data-target="#detailInvoiceResellerModal">
                                                <i class="material-icons">check</i>
                                            </button>
                                        </td>   
                                    </tr>

                                    <?php $no++;
                                    endforeach;
                                } else { ?>
                                    <tr class="alert alert-danger">
                                        <td colspan="9" align="center">Tidak ada daftar invoice.</td>
                                    </tr>   
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Colored Card - With Loading -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header cs-header-tambah-barang">
                <h2>
                    Daftar Invoice Merk
                </h2>
                <!-- <button type="button" class="btn btn-sm btn-primary waves-effect cs-btn-tambah-barang-r" data-toggle="modal" data-target="#defaultModalPost">
                    <i class="material-icons">add</i>
                    <span>Tambah Invoice</span>
                </button> -->
            </div>

            <div class="body">
                <div class="table-responsive cs-table-xflow">
                    <table class="table table-bordered table-striped table-hover dataTable js-basic-example cs-data-table">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Invoice</th>
                            <th>Nama Pembeli</th>
                            <th>Tanggal Transaksi</th>
                            <th>Jumlah Transaksi</th>
                            <th>Total Pembayaran</th>
                            <th>Sisa Pembayaran</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php
                        if (!empty($invoiceMerk)) {
                            $no = 1;
                            $param;
                            foreach ($invoiceMerk as $invoice):
                                $param = 'merk'.'.'.$invoice->id?>

                                <tr>
                                    <th scope="row"><?= $no; ?></th>
                                    <td style="width=20%"><?= $invoice->id; ?></td>
                                    <td><?= $invoice->nama_pembeli; ?></td>
                                    <td><?= $invoice->tgl_transaksi; ?></td>
                                    <td><?= 'Rp. '.strrev(implode('.',str_split(strrev(strval($invoice->jumlah_transaksi)),3))); ?></td>
                                    <td><?= 'Rp. '.strrev(implode('.',str_split(strrev(strval($invoice->total_pembayaran)),3))); ?></td>
                                    <td><?= 'Rp. '.strrev(implode('.',str_split(strrev(strval($invoice->total_tagihan)),3))); ?></td>
                                    <td><?= $invoice->status_invoice; ?></td>
                                    <td>
                                        <a type="button" class="btn btn-sm bg-light-blue waves-effect btn-detail-reseller" href="<?php echo base_url('adminroot/DetailInvoice/detailInvoice/').$param; ?>">
                                            <i class="material-icons">remove_red_eye</i>
                                        </a>
                                        <button type="button" class="btn btn-sm bg-light-green waves-effect btn-lunasi-merk" id="<?php echo $invoice->id ?>"  data-toggle="modal" data-target="#detailInvoiceMerkModal">
                                            <i class="material-icons">check</i>
                                        </button>
                                    </td>
                                </tr>

                                <?php $no++;
                            endforeach;
                        } else { ?>
                            <tr class="alert alert-danger">
                                <td colspan="9" align="center">Tidak ada daftar invoice.</td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- modal process -->
<div class="modal fade" id="detailInvoiceResellerModal" tabindex="-1" role="dialog" style="display: none;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
                <div class="modal-header bg-light-blue">
                    <h4 class="modal-title" id="defaultModalLabel">Add Invoice Reseller</h4>
                </div>
                <form action="<?php echo base_url('adminroot/invoice/insertHistoryInvoice'); ?>" method="post">
                    <div class="modal-body">
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 left">
                            <h3 class="h3 cs-rm-margin-top" id="namaReseller"></h3>
                            <h4 class="h4 cs-rm-margin-top" id="tglJualReseller"></h4>
                            <input id="inIdInvoice" name="inIdInvoice" class="form-control ">
                            <input id="inTglBayar" name="inTglBayar" class="form-control ">
                            <input id="inPembayaran" name="inPembayaran" class="form-control ">
                        </div>


                        <table class="table detail-barang" id="detail-barang">
                            <thead>
                                <tr>

                                    <th><h4>Kode Invoice</h4></th>
                                    <th><h4>Tanggal Pembayaran</h4></th>
                                    <th><h4>Nama Reseller</h4></th>
                                </tr>

                                <tr>
                                    <td><h5 name="kdinvoice" id="kodeInvoice"></h5></td>
                                    <td><h5 id="tglPembayaranReseller"></h5></td>
                                    <td><h5 id="namaResellerTb"></h5></td>
                                </tr>

                            </thead>
                            <tbody>
                            </tbody>
                        </table>



                        <h4>Form Pembayaran</h4>
                        <hr>


                        <div class="body">
                            <!-- row total tagihan -->
                            <div class="col-lg-12 cs-margin-bottom-20">
                            <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 left cs-margin-top-7">
                                <label>Total Tagihan : </label>
                            </div>
                            <div class="row col-lg-10 col-md-10 col-sm-12 col-xs-12 cs-margin-bottom-20">
                                <div class="form-line">
                                    <input readonly type="number" id="totalTagihanReseller" name="totalTagihanReseller" class="form-control">
                                </div>
                            </div>
        <!--                    <div class="row clearfix"></div>-->
                            <br>
                            <!-- end row total tagihan -->
                            <!-- row pembayaran -->
                            <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 left cs-margin-top-7">
                                <label>Pembayaran : </label>
                            </div>
                            <div class="row col-lg-10 col-md-10 col-sm-12 col-xs-12 cs-margin-bottom-20">
                                <input type="number" id="totalPembayaranReseller" class="form-control" value="0" onkeyup="countSisaTagihan()" >
                            </div>
        <!--                    <div class="row clearfix"></div>-->
                            <br>
                            <!-- end row pembayaran -->
                            <!-- row sisa tagihan -->
                            <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 left cs-margin-top-7">
                                <label>Kembalian : </label>
                            </div>
                            <div class="row col-lg-10 col-md-10 col-sm-12 col-xs-12 cs-margin-bottom-20">
                                <input readonly type="number" id="kembalianReseller" class="form-control" value="0">
                            </div>
                            <div class="row clearfix"></div>
                            <!-- end row sisa tagihan -->
                            <!-- row sisa tagihan -->
                            <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 left cs-margin-top-7">
                                <label>Sisa Tagihan : </label>
                            </div>
                            <div class="row col-lg-10 col-md-10 col-sm-12 col-xs-12 cs-margin-bottom-20">
                                <input readonly type="number" id="sisaTagihanReseller" name="sisaTagihanReseller" class="form-control" value="0">
                            </div>
                            <div class="row clearfix"></div>
                            <!-- end row sisa tagihan -->
                        </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary waves-effect">Bayar</button>
                        <button type="button" class="btn btn-primary waves-effect" data-dismiss="modal">Tutup</button>
                    </div>
                </form>
        </div>
    </div>
</div>

    <!-- modal process -->
    <div class="modal fade" id="detailInvoiceMerkModal" tabindex="-1" role="dialog" style="display: none;">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-light-blue">
                    <h4 class="modal-title" id="defaultModalLabel">Add Invoice Merk</h4>
                </div>
                <form action="<?php echo base_url('adminroot/invoice/insertHistoryInvoiceMerk'); ?>" method="post">
                    <div class="modal-body">
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 left">
                            <h3 class="h3 cs-rm-margin-top" id="namaReseller"></h3>
                            <h4 class="h4 cs-rm-margin-top" id="tglJualReseller"></h4>
                            <input id="inIdInvoiceMerk" name="inIdInvoiceMerk" class="form-control ">
                            <input id="inTglBayarMerk" name="inTglBayarMerk" class="form-control ">
                            <input id="inPembayaranMerk" name="inPembayaranMerk" class="form-control ">
                        </div>


                        <table class="table detail-barang" id="detail-barang">
                            <thead>
                            <tr>

                                <th><h4>Kode Invoice</h4></th>
                                <th><h4>Tanggal Pembayaran</h4></th>
                                <th><h4>Nama Pembeli</h4></th>
                            </tr>

                            <tr>
                                <td><h5 name="kdinvoiceMerk" id="kodeInvoiceMerk"></h5></td>
                                <td><h5 id="tglPembayaranMerk"></h5></td>
                                <td><h5 id="namaPembeliTb"></h5></td>
                            </tr>

                            </thead>
                            <tbody>
                            </tbody>
                        </table>



                        <h4>Form Pembayaran</h4>
                        <hr>


                        <div class="body">
                            <!-- row total tagihan -->
                            <div class="col-lg-12 cs-margin-bottom-20">
                                <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 left cs-margin-top-7">
                                    <label>Total Tagihan : </label>
                                </div>
                                <div class="row col-lg-10 col-md-10 col-sm-12 col-xs-12 cs-margin-bottom-20">
                                    <div class="form-line">
                                        <input readonly type="number" id="totalTagihanMerk" name="totalTagihanMerk" class="form-control">
                                    </div>
                                </div>
                                <!--                    <div class="row clearfix"></div>-->
                                <br>
                                <!-- end row total tagihan -->
                                <!-- row pembayaran -->
                                <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 left cs-margin-top-7">
                                    <label>Pembayaran : </label>
                                </div>
                                <div class="row col-lg-10 col-md-10 col-sm-12 col-xs-12 cs-margin-bottom-20">
                                    <input type="number" id="totalPembayaranMerk" class="form-control" value="0" onkeyup="countSisaTagihanMerk()" >
                                </div>
                                <!--                    <div class="row clearfix"></div>-->
                                <br>
                                <!-- end row pembayaran -->
                                <!-- row sisa tagihan -->
                                <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 left cs-margin-top-7">
                                    <label>Kembalian : </label>
                                </div>
                                <div class="row col-lg-10 col-md-10 col-sm-12 col-xs-12 cs-margin-bottom-20">
                                    <input readonly type="number" id="kembalianMerk" class="form-control" value="0">
                                </div>
                                <div class="row clearfix"></div>
                                <!-- end row sisa tagihan -->
                                <!-- row sisa tagihan -->
                                <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 left cs-margin-top-7">
                                    <label>Sisa Tagihan : </label>
                                </div>
                                <div class="row col-lg-10 col-md-10 col-sm-12 col-xs-12 cs-margin-bottom-20">
                                    <input readonly type="number" id="sisaTagihanMerk" name="sisaTagihanMerk" class="form-control" value="0">
                                </div>
                                <div class="row clearfix"></div>
                                <!-- end row sisa tagihan -->
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary waves-effect">Bayar</button>
                        <button type="button" class="btn btn-primary waves-effect" data-dismiss="modal">Tutup</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<!--  End Modal Proses  -->

<script src="<?= base_url('assets/plugins/jquery/jquery.min.js'); ?>"></script>

<script>

    var hari = new Date();
    var bulan = hari.getMonth()+1;
    document.getElementById("tglPembayaranReseller").innerHTML = hari.getDate()+"-"+bulan+"-"+hari.getFullYear();
    document.getElementById("tglPembayaranMerk").innerHTML = hari.getDate()+"-"+bulan+"-"+hari.getFullYear();

    $(".btn-lunasi-reseller").click(function () {
        console.log(this.id);
        var idInvoiceReseller = this.id;

        $.post('<?php echo base_url('adminroot/invoice/getDataInvoiceResellerById') ?>',
           {
               id: idInvoiceReseller
           },
           function(data, status){
              console.log("Data: " + data + "\nStatus: " + status);

              var data_obj = JSON.parse(data);
              console.log(data_obj);

               $("#totalTagihanReseller").val(data_obj.invoiceReseller[0].total_tagihan);
               document.getElementById("kodeInvoice").innerHTML = data_obj.invoiceReseller[0].id;
               $("#inIdInvoice").val(data_obj.invoiceReseller[0].id);
               $("#inTglBayar").val(hari.getFullYear()+"-"+bulan+"-"+hari.getDate());
               document.getElementById("namaResellerTb").innerHTML = data_obj.invoiceReseller[0].nama_reseller;
           });
    })

    $(".btn-lunasi-merk").click(function () {
        console.log(this.id);
        var idInvoiceMerk = this.id;

        $.post('<?php echo base_url('adminroot/invoice/getDataInvoiceMerkById') ?>',
            {
                id: idInvoiceMerk
            },
            function(data, status){
                console.log("Data: " + data + "\nStatus: " + status);

                var data_obj = JSON.parse(data);

                console.log(data_obj);

                $("#totalTagihanMerk").val(data_obj.invoiceMerk[0].total_tagihan);
                document.getElementById("kodeInvoiceMerk").innerHTML = data_obj.invoiceMerk[0].id;
                $("#inIdInvoiceMerk").val(data_obj.invoiceMerk[0].id);
                $("#inTglBayarMerk").val(hari.getFullYear()+"-"+bulan+"-"+hari.getDate());
                document.getElementById("namaPembeliTb").innerHTML = data_obj.invoiceMerk[0].nama_pembeli;
            });
    })
    
    function countSisaTagihan() {
        var totalTagihan = document.getElementById('totalTagihanReseller').value;
        var pembayaran = document.getElementById('totalPembayaranReseller').value;

        var x = parseInt(totalTagihan);
        var y = parseInt(pembayaran);


        if (y > x){
            console.log("Masuk ke if");
            document.getElementById('inPembayaran').value = pembayaran;
            document.getElementById('sisaTagihanReseller').value = 0;
            document.getElementById('kembalianReseller').value = y - x;
        } else {
            console.log("Masuk ke else");
            document.getElementById('inPembayaran').value = pembayaran;
            document.getElementById('sisaTagihanReseller').value = x - y;
            document.getElementById('kembalianReseller').value = 0;
        }


    }

    function countSisaTagihanMerk() {
        var totalTagihan = document.getElementById('totalTagihanMerk').value;
        var pembayaran = document.getElementById('totalPembayaranMerk').value;

        var x = parseInt(totalTagihan);
        var y = parseInt(pembayaran);


        if (y > x){
            console.log("Masuk ke if");
            document.getElementById('inPembayaranMerk').value = pembayaran;
            document.getElementById('sisaTagihanMerk').value = 0;
            document.getElementById('kembalianMerk').value = y - x;
        } else {
            console.log("Masuk ke else");
            document.getElementById('inPembayaranMerk').value = pembayaran;
            document.getElementById('sisaTagihanMerk').value = x - y;
            document.getElementById('kembalianMerk').value = 0;
        }


    }


</script>
