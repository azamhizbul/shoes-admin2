<!-- title container -->
<div class="block-header">
    <h2>Pengelolaan Vendor</h2>
</div>
<!-- end title container -->

<?= showFlashMessage(); ?>

<!-- Colored Card - With Loading -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Daftar Vendor
                </h2>
                <button type="button" class="btn btn-sm btn-primary waves-effect cs-btn-tambah-barang-r" data-toggle="modal" data-target="#defaultModal">
                    <i class="material-icons">add</i>
                    <span>Tambah Vendor</span>
                </button>
            </div>

             <div class="body">
                <div class="table-responsive cs-table-xflow">
                    <table class="table table-bordered table-striped table-hover dataTable js-basic-example cs-data-table">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>NAMA VENDOR</th>
                                <th>NO TELEPON</th>
                                <th>ALAMAT</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php 
                                if (!empty($listvendor)) {
                                    $no = 1;

                                    foreach ($listvendor as $vendor): ?>

                                    <tr>
                                        <th scope="row"><?= $no; ?></th>
                                        <td><?= $vendor->nama_vendor; ?></td>
                                        <td><?= $vendor->no_handphone; ?></td>
                                        <td><?= $vendor->alamat; ?></td>
                                        <td>
                                    <button type="button" id="<?php echo $vendor->id_vendor ?>" class="btn btn-sm btn-primary waves-effect btn-edit" data-toggle="modal" data-target="#defaultModalEdit">
                                        <i class="material-icons">edit</i>
                                    </button>
                                    <button type="button" class="btn btn-sm bg-red waves-effect btn-delete" id="<?php echo $vendor->id_vendor ?>"  data-toggle="modal" data-target="#modalDelete">
                                        <i class="material-icons">delete</i>
                                    </button>
                                </td>   
                                    </tr>

                                    <?php $no++;
                                    endforeach;
                                } else { ?>
                                    <tr class="alert alert-danger">
                                        <td colspan="7" align="center">Tidak ada daftar vendor.</td>
                                    </tr>   
                            <?php } ?>
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light-blue">
                <h4 class="modal-title" id="defaultModalLabel">Form Pengelolaan Vendor</h4>
            </div>
            <div class="modal-body">
                <form id="vInserVendor" action="<?php echo base_url('adminroot/Pengelolaan_vendor/inserVendor'); ?>" method="post">
                    <label>Nama Vendor</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" name="NamaVendorPost" id="NamaVendorPost" class="form-control" placeholder="Masukan Nama Vendor" required>
                        </div>
                    </div>
                    <label>No Handphone</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" name="NoHpVendorPost" id="NoHpVendorPost" class="form-control" placeholder="Masukan No Handphone" required>
                        </div>
                    </div>
                    <label>Alamat</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" name="AlamatVendorPost" id="AlamatVendorPost" class="form-control" placeholder="Masukan Alamat" required>
                        </div>
                    </div>
                    <br>
            </div>
            <div class="modal-footer">
                <button type="sumbit" class="btn btn-primary btn-sm waves-effect">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="defaultModalEdit" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light-blue">
                <h4 class="modal-title" id="defaultModalLabel">Form Pengelolaan Vendor</h4>
            </div>
            <div class="modal-body">
                <form id="vEditVendor" action="<?php echo base_url('adminroot/Pengelolaan_vendor/saveUpadteVendor'); ?>" method="post">
                    <div class="form-group hidden-xs hidden-sm hidden-ls hidden-md hidden-lg">
                        <div class="form-line">
                            <input type="text" name="IdVendor" id="IdVendor" class="form-control" placeholder="Masukan Nama Vendor" required>
                        </div>
                    </div>
                    <label>Nama Vendor</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" name="NamaVendor" id="NamaVendor" class="form-control" placeholder="Masukan Nama Vendor" required>
                        </div>
                    </div>
                    <label>No Handphone</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" name="NoHpVendor" id="NoHpVendor" class="form-control" placeholder="Masukan No Handphone" required>
                        </div>
                    </div>
                    <label>Alamat</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" name="AlamatVendor" id="AlamatVendor" class="form-control" placeholder="Masukan Alamat"required>
                        </div>
                    </div>
                    <br>
            </div>
            <div class="modal-footer">
                <button type="sumbit" class="btn btn-primary btn-sm waves-effect">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-red">
                <h4 class="modal-title" id="defaultModalLabel">Hapus Vendor</h4>
            </div>
            <div class="modal-body">
                <h5 class="h4">Apakah anda yakin Vendor <b id="NamaVendorDel"></b> akan dihapus?</h4>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-sm btn-danger waves-effect hapus">
                        <i class="material-icons">delete</i>
                        <span>Hapus</span>
                    </a>
                    <a type="button" class="btn btn-default btn-sm waves-effect" data-dismiss="modal">
                        <i class="material-icons">close</i>
                        <span>Close</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Colored Card - With Loading -->

    <!-- Jquery Core Js -->
    

    <script>

        $('#vInserVendor').validate();
        $('#vEditVendor').validate();
         // get fine One Update
    $(".btn-edit").click(function(){
        console.log(this.id);
        var idBarang = this.id;
        $.post("<?php echo base_url('adminroot/Pengelolaan_vendor/findOneVendor') ?>",
    {
        id: idBarang
    },
    function(data, status){
        console.log("Data: " + data + "\nStatus: " + status);
        var data_objek = JSON.parse(data);
          $("#IdVendor").val(data_objek.vendor[0].id_vendor);
          $("#NamaVendor").val(data_objek.vendor[0].nama_vendor);
          $("#AlamatVendor").val(data_objek.vendor[0].alamat);
          $("#NoHpVendor").val(data_objek.vendor[0].no_handphone);
          $('#modal_large').modal('toggle');
    });
    })

    // get fine One delete
    $(".btn-delete").click(function(){
        console.log(this.id);
        var idBarang = this.id;
        $.post("<?php echo base_url('adminroot/Pengelolaan_vendor/findOneVendor') ?>",
    {
        id: idBarang
    },
    function(data, status){
        console.log("Data: " + data + "\nStatus: " + status);
        var data_objek = JSON.parse(data);
        document.getElementById("NamaVendorDel").innerHTML = data_objek.vendor[0].nama_vendor;
        document.getElementsByClassName("hapus")[0].setAttribute("id",data_objek.vendor[0].id_vendor);
        document.getElementsByClassName("hapus")[0].setAttribute("name",data_objek.vendor[0].id_vendor);
        document.getElementsByClassName("hapus")[0].setAttribute("href","<?php echo base_url('adminroot/Pengelolaan_vendor/deleteVendor/') ?>"+data_objek.vendor[0].id_vendor);
        $('#modal_large').modal('toggle');
    });
                 })



    </script>
