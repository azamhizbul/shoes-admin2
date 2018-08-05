<!DOCTYPE html>
<html>
<head>
    <title><?= $title; ?></title>
    <style>
        * {
            margin: 0px;
            padding: 0px;
        }

        body {
            font-family: sans-serif;
            line-height: 1.6;
        }

        .header {
            background-color: #03a9f4;
            padding: 15px;
            color: #fff;
        }

        .container {
            margin: 15px;
            font-size: 12px;
        }

        .pull-left {
            float: left;
        }

        .pull-right {
            float: right;
        }

        .clear {
            clear: both;
        }

        .garis {
            border-bottom: 1px solid #999;
            margin-top: 10px;
        }
         .table1 th{
            border: 0px !important;
            font-weight: normal;
            
        }

        .table {
            font-size: 12px;
            color: #232323;
            border-collapse: collapse;
            width: 100%;
            text-align: center;
        }

        .table, th, td {
            border: 1px solid #999;
        }

        .footer {
            padding: 0px 20px;
        }
       
        .textleft{
            text-align: left !important;
        }
        .textright{
            text-align: right !important;
        }

        .margin10top {
            margin-top: 30px;
        }
        .textbold{
            font-weight: bold;
        }

    </style>
</head>
<body>

    <div class="header">
        <p>
            BUKTI PEMBAYARAN RESELLER
        </p>
    </div>
    
    <div class="container">
        <table class="table1">
            <tr>
                <th width="270px" class="textleft">
                <p>Toko Maju Jaya</p>
                <P>Email : <label>majujaya@gmail.com</label></P>
                <P>Telepon : <label>00000000</label></P> 
                </th>
                <!-- <th width="250px" class="textleft">
                    <p class="pull-left">#No. Transaksi: <?php echo $invoiceReseller[0]->id_transaksi_reseller; ?></p>
                <p class="pull-right">Kasir : <?= $invoiceReseller[0]->nama; ?></p>                
                <p>Tanggal Pembelian : <?= $invoiceReseller[0]->tgl_jual; ?></p>
                </th> -->
                
            </tr>
        </table>

         <div class="garis"></div><br>

         <table class="table1">
            <tr>
                <th width="270px" class="textleft">
                 <div class="pull-left">
                    <h4>Reseller Details : </h4>
                    <p>
                        <!-- Nama Reseller : <?= $invoiceReseller[0]->nama_reseller; ?><br />
                        Alamat : <?= $invoiceReseller[0]->alamat; ?> -->
                    </p>
                </div>

                </th>
                <th width="250px" class="textleft">
                   <h4>Reseller Contact :</h4>
            <p>
                <!-- No. Handphone : <?= $invoiceReseller[0]->no_handphone; ?><br />
                email : <?= $invoiceReseller[0]->email; ?> -->
            </p>
                </th>
                
            </tr>
        </table>
        
        <div class="margin10top">
            <!-- Begin Paste -->
            <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <strong>ITEM DESCRIPTION & DETAILS :</strong>
                            </div>
                        </div>
                        <hr />

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Barang</th>
                                            <th>Produk</th>
                                            <th>Jumlah Beli</th>
                                            <th>Harga Satuan</th>
                                            <th>Total</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $no = 1;
                                        $totalItem = 0;
                                        $totalPembayaran = 0;
                                        foreach ($detailBarang as $barang): ?>
                                            <tr>
                                                <th scope="row"><?= $no; ?></th>
                                                <td><?= $barang->id_barang; ?></td>
                                                <td><?= $barang->produk; ?></td>
                                                <td><?= $barang->total_item;
                                                        $totalItem = $totalItem + $barang->total_item; ?></td>
                                                <td><?= 'Rp. '.strrev(implode('.',str_split(strrev(strval($barang->harga)),3))); ?></td>
                                                <td><?= 'Rp. '.strrev(implode('.',str_split(strrev(strval($barang->total)),3)));
                                                        $totalPembayaran = $totalPembayaran + $barang->total; ?></td>
                                            </tr>
                                        <?php $no++;
                                        endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <hr>
                                <div>
                                    <h5>Total Item : <?= $totalItem; ?></h5>
                                    <h5>Total Pembayaran : Rp.  <?= strrev(implode('.',str_split(strrev(strval($totalPembayaran)),3))); ?></h5>
                                </div>
                                <hr>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <strong>HISTORY INVOICE :</strong>
                            </div>
                        </div>
                        <hr />

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Pembayaran Ke</th>
                                            <th>Tanggal Bayar</th>
                                            <th>Tagihan</th>
                                            <th>Total Bayar</th>
                                            <th>Sisa Tagihan</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $no = 1;
                                        $totalBayar = 0;
                                        $twoParam ;
                                        foreach ($historyInvoice as $invoice):
                                            $twoParam = (string)$invoice->id_history.".".$invoice->id_invoice;
                                            ?>

                                            <tr>
                                                <th scope="row"><?= $no; ?></th>
                                                <td><?= $invoice->tanggal_pembayaran; ?></td>
                                                <td><?= 'Rp. '.strrev(implode('.',str_split(strrev(strval($invoice->total_tagihan)),3))); ?></td>
                                                <td><?= 'Rp. '.strrev(implode('.',str_split(strrev(strval($invoice->pembayaran_tagihan)),3)));
                                                        $totalBayar = $totalBayar + $invoice->pembayaran_tagihan; ?></td>
                                                <td><?= 'Rp. '.strrev(implode('.',str_split(strrev(strval($invoice->sisa_tagihan)),3))); ?></td>
                                            </tr>
                                        <?php $no++;
                                        endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                                <hr>
                                <div>
                                    <h5>Total Bayar : <?= 'Rp. '.strrev(implode('.',str_split(strrev(strval($totalBayar)),3)));?></h5>
                                    <h5>Sisa Tagihan : <?= 'Rp. '.strrev(implode('.',str_split(strrev(strval($historyInvoice[count($historyInvoice)-1]->sisa_tagihan)),3)));?></h5>
                                </div>
                                <hr>
                            </div>
                        </div>

            <!-- End paste -->

        <!-- <h4 style="margin-top: 10px">ITEM DESCRIPTION & DETAILS :</h4>
        </div>
        <table class="table">
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
                <?php foreach ($invoiceReseller as $invReseller) {  ?>
                    <tr>
                        <td><?= $invReseller->nama_merk; ?></td>
                        <td><?= $invReseller->warna; ?></td>
                        <td><?= $invReseller->ukuran; ?></td>
                        <td><?= $invReseller->total_item; ?></td>
                        <td><?= $invReseller->harga_reseller; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table><br><br>

        <p>  Total : <label class="textbold">Rp. <?= strrev(implode('.',str_split(strrev(strval($invoiceReseller[0]->total_tagihan)),3))); ?></label></p>
        <p>  Potongan Harga : <label class="textbold">Rp. <?= strrev(implode('.',str_split(strrev(strval($invoiceReseller[0]->potongan_harga)),3))); ?></label></p>
        <p>  Uang Pembayaran : <label class="textbold">Rp. <?= strrev(implode('.',str_split(strrev(strval($invoiceReseller[0]->pembayaran_tagihan)),3))); ?></label></p>
        <p>  Uang Kembalian : <label class="textbold">Rp. <?= strrev(implode('.',str_split(strrev(strval($invoiceReseller[0]->uang_kembalian)),3))); ?></label></p>
        <p>  Sisa Pembayaran : <label class="textbold">Rp. <?= strrev(implode('.',str_split(strrev(strval($invoiceReseller[0]->sisa_tagihan)),3))); ?></label></p>
        <div class="garis"></div><br> -->
        
        <strong>Catatan : </strong>    
        <div class="footer">
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

</body>
</html>