<!-- title container -->
<div class="block-header">
    <h2>Pengelolaan Reseller</h2>
</div>
<!-- end title container -->

<?= showFlashMessage(); ?>

 <!-- Colored Card - With Loading -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Daftar Reseller
                            </h2>
                            <button type="button" class="btn btn-sm btn-primary waves-effect cs-btn-tambah-barang-r" data-toggle="modal" data-target="#defaultModal">
                                <i class="material-icons">add</i>
                                <span>Tambah Reseller</span>
                            </button>
                        </div>

                         <div class="body">
                <div class="table-responsive cs-table-xflow">
                    <table class="table table-bordered table-striped table-hover dataTable js-basic-example cs-data-table">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>NAMA RESELLER</th>
                                <th>NO HANDPHONE</th>
                                <th>ALAMAT</th>
                                <th>EMAIL</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>

                        <tbody>
                                     <?php 
                                if (!empty($listreseller)) {
                                    $no = 1;

                                    foreach ($listreseller as $reseller): ?>

                                    <tr>
                                        <th scope="row"><?= $no; ?></th>
                                        <td><?= $reseller->nama_reseller; ?></td>
                                        <td><?= $reseller->no_handphone; ?></td>
                                        <td><?= $reseller->alamat; ?></td>
                                        <td><?= $reseller->email; ?></td>
                                        <td>
                                    <button type="button" id="<?php echo $reseller->id_reseller ?>" class="btn btn-sm btn-primary waves-effect btn-edit" data-toggle="modal" data-target="#defaultModalEdit">
                                        <i class="material-icons">edit</i>
                                    </button>
                                    <button type="button" class="btn btn-sm bg-red waves-effect btn-delete" id="<?php echo $reseller->id_reseller ?>"  data-toggle="modal" data-target="#modalDelete">
                                        <i class="material-icons">delete</i>
                                    </button>
                                </td>   
                                    </tr>

                                    <?php $no++;
                                    endforeach;
                                } else { ?>
                                    <tr class="alert alert-danger">
                                        <td colspan="7" align="center">Tidak ada daftar reseller.</td>
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
                            <h4 class="modal-title" id="defaultModalLabel">Form Pengelolaan Reseller</h4>
                        </div>
                        <div class="modal-body">
                            <form id="vInserResel" action="<?php echo base_url('adminroot/Pengelolaan_reseller/insertReseller') ?>" method="post">
                                <label>Nama Reseller</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="NamaResellerPost" id="NamaResellerPost" class="form-control" placeholder="Masukan Nama Reseller" required>
                                    </div>
                                </div>
                                <label>No Handphone</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="NoHpResellerPost" id="NoHpResellerPost" class="form-control" placeholder="Masukan No Handphone" required>
                                    </div>
                                </div>
                                <label>Alamat</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="AlamatResellerPost" id="AlamatResellerPost" class="form-control" placeholder="Masukan Alamat" required>
                                    </div>
                                </div>
                                <label>Email</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="EmailResellerPost" id="EmailResellerPost" class="form-control" placeholder="Masukan Email" required>
                                    </div>
                                </div>
                                <br>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary bg-sm waves-effect">Simpan</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="defaultModalEdit" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-light-blue">
                            <h4 class="modal-title" id="defaultModalLabel">Form Pengelolaan Reseller</h4>
                        </div>
                        <div class="modal-body">
                            <form id="vEditResel" action="<?php echo base_url('adminroot/Pengelolaan_reseller/saveUpdteReseller') ?>" method="post">
                                <div class="form-group hidden-xs hidden-sm hidden-ls hidden-md hidden-lg">
                                    <div class="form-line">
                                        <input type="text" name="IdReseller" id="IdReseller" class="form-control" placeholder="Masukan Nama Reseller" required>
                                    </div>
                                </div>
                                <label>Nama Reseller</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="NamaReseller" id="NamaReseller" class="form-control" placeholder="Masukan Nama Reseller" required>
                                    </div>
                                </div>
                                <label>No Handphone</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="NoHpReseller" id="NoHpReseller" class="form-control" placeholder="Masukan No Handphone" required>
                                    </div>
                                </div>
                                <label>Alamat</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="AlamatReseller" id="AlamatReseller" class="form-control" placeholder="Masukan Alamat" required>
                                    </div>
                                </div>
                                <label>Email</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="EmailReseller" id="EmailReseller" class="form-control" placeholder="Masukan Email" required>
                                    </div>
                                </div>
                                <br>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary bg-sm waves-effect">Simpan</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modalDelete" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-red">
                            <h4 class="modal-title" id="defaultModalLabel">Hapus Reseller</h4>
                        </div>
                        <div class="modal-body">
                            <h4 class="h4">Apakah anda yakin akan menghapus <b id="NamaResellerDel"></b> sebagai reseller ? </h4>
                        </div>
                        <div class="modal-footer">
                            <a class="btn btn-sm btn-danger waves-effect hapus" id="">
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
    <script>

        $('#vInserResel').validate();
        $('#vEditResel').validate();

         // get fine One Update
    $(".btn-edit").click(function(){
        console.log(this.id);
        var idBarang = this.id;
        $.post("<?php echo base_url('adminroot/Pengelolaan_reseller/findOneReseller') ?>",
    {
        id: idBarang
    },
    function(data, status){
        console.log("Data: " + data + "\nStatus: " + status);
        var data_objek = JSON.parse(data);
          $("#IdReseller").val(data_objek.reseller[0].id_reseller);
          $("#NamaReseller").val(data_objek.reseller[0].nama_reseller);
          $("#AlamatReseller").val(data_objek.reseller[0].alamat);
          $("#NoHpReseller").val(data_objek.reseller[0].no_handphone);
          $("#EmailReseller").val(data_objek.reseller[0].email);
          $('#modal_large').modal('toggle');
    });
    })

    // get fine One delete
    $(".btn-delete").click(function(){
        console.log(this.id);
        var idBarang = this.id;
        $.post("<?php echo base_url('adminroot/Pengelolaan_reseller/findOneReseller') ?>",
    {
        id: idBarang
    },
    function(data, status){
        console.log("Data: " + data + "\nStatus: " + status);
        var data_objek = JSON.parse(data);
        document.getElementById("NamaResellerDel").innerHTML = data_objek.reseller[0].nama_reseller;
        document.getElementsByClassName("hapus")[0].setAttribute("id",data_objek.reseller[0].id_reseller);
        document.getElementsByClassName("hapus")[0].setAttribute("name",data_objek.reseller[0].id_reseller);
        document.getElementsByClassName("hapus")[0].setAttribute("href","<?php echo base_url('adminroot/Pengelolaan_reseller/deleteReseller/') ?>"+data_objek.reseller[0].id_reseller);
        $('#modal_large').modal('toggle');
    });
                 })



    </script>
