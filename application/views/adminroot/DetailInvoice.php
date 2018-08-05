
<!-- Colored Card - With Loading -->
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header bg-light-blue">
                <h2>
                    Detail Invoice
                </h2>
            </div>
            <div class="body">
                <div class="col-md-12 text-center"></div>
                <div class="row color-invoice">
                    <div class="col-md-12">

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
                                            <th></th>
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
                                                <td>
                                                    <a href="<?= base_url('adminroot/DetailInvoice/buktiPembayaran/'.$twoParam); ?>" class="btn btn-primary waves-effect btn-edit">
                                                        <i class="material-icons">remove_red_eye</i>
                                                        <span>Detail</span>
                                                    </a>
                                                </td>
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

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <strong>Catatan : </strong>
                            </div>
                        </div>


                        <?php 
                            $id = $historyInvoice[0]->id_invoice;
                            $ids = explode("-", $id);
                            $jenis = $ids[0];
                            $param;
                            if ($jenis == "TSRES") {
                                $param = "res".".".$id;
                                echo $param;
                            } else {
                                $param = "merk".".".$id;
                                echo $param;
                            }
                            
                        ?>

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                    <a href="<?= base_url('adminroot/DetailInvoice/cetakBuktiDetailInvoice/'.$param); ?>" title="Cetak Bukti Pembayaran" target="_blank" class="btn bg-light-green">
                                        <i class="material-icons">print</i>
                                        <span>Cetak</span>
                                    </a>
                                <a href="<?= base_url('adminroot/invoice/'); ?>" title="Kembali" class="btn bg-light-blue">
                                    <i class="material-icons">arrow_back</i>
                                    <span>Kembali</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- #END# Colored Card - With Loading -->