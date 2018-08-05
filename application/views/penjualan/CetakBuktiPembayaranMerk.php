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
            Maju Jaya
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
                <th width="250px" class="textleft">
                  <p class="pull-left">#No. Transaksi: <?php echo $invoiceMerk[0]->id_transaksi_merk; ?></p>
        <p class="pull-right">Kasir : <?= $invoiceMerk[0]->nama; ?></p>
        <p>Tanggal Pembelian : <?= $invoiceMerk[0]->tgl_jual; ?></p>
                </th>
                
            </tr>
        </table>

         <div class="garis"></div><br>

         <table class="table1">
            <tr>
                <th width="270px" class="textleft">
                 <div class="pull-left">
                     <h3>Nama Pembeli : </h3>
        <p><?= $invoiceMerk[0]->nama_pembeli; ?> </p>
        
                </div>

                </th>
                
            </tr>
        </table>
        
        <div class="margin10top">
        <h4 style="margin-top: 10px">ITEM DESKRIPSI & DETAIL :</h4>
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
                <?php foreach ($invoiceMerk as $invMerk) {  ?>
                    <tr>
                        <td><?= $invMerk->nama_merk; ?></td>
                        <td><?= $invMerk->warna; ?></td>
                        <td><?= $invMerk->ukuran; ?></td>
                        <td><?= $invMerk->total_item; ?></td>
                        <td><?= $invMerk->harga_jual_vendor; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table><br><br>

        <p>  Total : <label class="textbold">Rp. <?= strrev(implode('.',str_split(strrev(strval($invoiceMerk[0]->total_tagihan)),3))); ?></label></p>
        <p>  Potongan Harga : <label class="textbold">Rp. <?= strrev(implode('.',str_split(strrev(strval($invoiceMerk[0]->potongan_harga)),3))); ?></label></p>
        <p>  Uang Pembayaran : <label class="textbold">Rp. <?= strrev(implode('.',str_split(strrev(strval($invoiceMerk[0]->pembayaran_tagihan)),3))); ?></label></p>
        <p>  Uang Kembalian : <label class="textbold">Rp. <?= strrev(implode('.',str_split(strrev(strval($invoiceMerk[0]->uang_kembalian)),3))); ?></label></p>
        <p>  Sisa Pembayaran : <label class="textbold">Rp. <?= strrev(implode('.',str_split(strrev(strval($invoiceMerk[0]->sisa_tagihan)),3))); ?></label></p>
        <div class="garis"></div><br>
        
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