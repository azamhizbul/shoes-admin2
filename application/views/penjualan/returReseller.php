<!-- Exportable Table -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    List Retur Pemesanan
                </h2>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover dataTable js-basic-example">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Barang</th>
                                <th>Vendor</th>
                                <th>Jumlah</th>
                                <th>Tanggal Pemesanan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Nike</td>
                                <td>PT. ABC Indonesia</td>
                                <td>2</td>
                                <td>02 April 2018</td>
                                <td>
                                    <button class="btn btn-primary waves-effect" data-toggle="modal" data-target="#defaultModal">
                                        <i class="material-icons">remove_red_eye</i>
                                        <span>Detail</span>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- #END# Exportable Table -->

<div class="modal fade" id="defaultModal" tabindex="-1" role="dialog" style="display: none;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light-blue">
                <h4 class="modal-title" id="defaultModalLabel">Detil Retur Barang</h4>
            </div>
            <div class="modal-body">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 left">
                    <h3 class="h3 cs-rm-margin-top">PT. ABC</h3>
                    <h4 class="h4 cs-rm-margin-top">02/04/2018</h4>
                </div> 

                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 right">
                    <label>Tanggal Retur</label>
                    <h4 class="h4 cs-rm-margin-top"><?= date('d/m/Y'); ?></h4> 
                </div>

                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama Barang</th>
                            <th>Warna</th>
                            <th>Size</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Nike</td>
                            <td>Hitam</td>
                            <td>43</td>
                            <td>2</td>
                        </tr>
                    </tbody>
                </table>

                <div class="body">
                    <label>Keterangan : </label>
                    <p>Ukuran kanan tidak sesuai pesanan</p>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-primary waves-effect" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<!--End modal process -->