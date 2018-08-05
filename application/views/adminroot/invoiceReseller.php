 <!-- Colored Card - With Loading -->
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header bg-light-blue">
                <h2>
                    Invoice Reseller
                </h2>
            </div>
            <div class="body">
                <div class="col-md-12 text-center"></div>
                <div class="row color-invoice">
                    <div class="col-md-12">
                        #No. Invoice: <?php echo $invoicePeritem[0]->id_invoice; ?>
                        <div class="row">
                            <div class="col-lg-7 col-md-7 col-sm-7">
                                <h1>INVOICE</h1>
                                <br />
                                <strong>Email : </strong> <?= $invoicePeritem[0]->email; ?>
                                <br />
                                <strong>Call : </strong> <?= $invoicePeritem[0]->no_handphone; ?>
                            </div>
                            
                            <!-- <div class="col-lg-5 col-md-5 col-sm-5">
                                <h2>   Html Snipp LLC</h2> 789/89 , Lane Set , New York,
                                <br> Pin- 90-89-78-00,
                                <br> United States.
                            </div> -->
                        </div>
                        <hr />

                        <div class="row">
                            <div class="col-lg-7 col-md-7 col-sm-7">
                                <h3>Client Details : </h3>
                                <h5><?= $invoicePeritem[0]->nama_reseller; ?> </h5> <?= $invoicePeritem[0]->alamat; ?>
                            </div>
                            <div class="col-lg-5 col-md-5 col-sm-5">
                                <h3>Client Contact :</h3> Mob: <?= $invoicePeritem[0]->no_handphone; ?>
                                <br> email: <?= $invoicePeritem[0]->email; ?>
                            </div>
                        </div>
                        <hr />
        
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
                                              <th>Nama Barang</th>
                                              <th>Warna</th>
                                              <th>Ukuran</th>
                                              <th>Jumlah</th>
                                              <th>Harga /item</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><?= $invoicePeritem[0]->nama_merk; ?></td>
                                                <td><?= $invoicePeritem[0]->warna; ?></td>
                                                <td><?= $invoicePeritem[0]->ukuran; ?></td>
                                                <td><?= $invoicePeritem[0]->total_item; ?></td>
                                                <td><?= 'Rp. '.strrev(implode('.',str_split(strrev(strval($invoicePeritem[0]->harga_jual)),3))); ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <hr>
                                <div>
                                    <h4>  Total : <?= 'Rp. '.strrev(implode('.',str_split(strrev(strval($invoicePeritem[0]->total_tagihan)),3))); ?></h4>
                                    <h4>  Uang Masuk : <?= 'Rp. '.strrev(implode('.',str_split(strrev(strval($invoicePeritem[0]->pembayaran_tagihan)),3))); ?></h4>
                                    <h4>  Sisa Pembayaran : <?= 'Rp. '.strrev(implode('.',str_split(strrev(strval($invoicePeritem[0]->sisa_tagihan)),3))); ?></h4>
                                </div>
                                <hr>
                               <!--  <div>
                                    <h4>  Taxes : 4400 USD ( 20 % on Total Bill ) </h4>
                                </div>
                                <hr> -->
<!--                                 <div>
                                    <h3>  Bill Amount : 26400 USD </h3>
                                </div>
                                <hr /> -->
                            </div>
                        </div>
        
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <strong> Important: </strong>
                                <ol>
                                    <li>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                    </li>
                                    <li>
                                        Nulla eros eros, laoreet non pretium sit amet, efficitur eu magna.
                                    </li>
                                    <li>
                                        Curabitur efficitur vitae massa quis molestie. Ut quis porttitor justo, sed euismod tortor.
                                    </li>
                                </ol>
                            </div>
                        </div>
                        <hr />
        
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <a href="#" class="btn bg-green">Print Invoice</a>    
                                <a href="<?php echo base_url('adminroot/PenjualanAdmin/riwayatPenjualanReseller/'); ?>" class="btn btn-primary">kembali</a>
                            </div>
                        </div>
                        <hr>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- #END# Colored Card - With Loading -->