<!-- title container -->
<div class="block-header">
    <h2>Pengelolaan Akun</h2>
</div>
<!-- end title container -->

<?= showFlashMessage(); ?>

<!-- Colored Card - With Loading -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Daftar Akun
                </h2>
                    <button type="button" class="btn btn-sm btn-primary waves-effect cs-btn-tambah-barang-r" data-toggle="modal" data-target="#addAkunModal">
                        <i class="material-icons">add</i>
                        <span>Tambah Akun</span>
                    </button>
            </div>

            <div class="body">
                <div class="table-responsive cs-table-xflow">
                    <table class="table table-bordered table-striped table-hover dataTable js-basic-example cs-data-table">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>NAMA</th>
                                <th>USERNAME</th>
                                <th>NO HANDPHONE</th>
                                <th>HAK AKSES</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>

                       <tbody>
                            <?php 
                                if (!empty($listakun)) {
                                    $no = 1;

                                    foreach ($listakun as $akun): ?>

                                    <tr>
                                        <th scope="row"><?= $no; ?></th>
                                        <td><?= $akun->nama; ?></td>
                                        <td><?= $akun->username; ?></td>
                                        <td><?= $akun->no_handphone; ?></td>
                                        <td><?= $akun->hak_akses; ?></td>
                                        <td>
                                            <button type="button" id="<?php echo $akun->id_user; ?>" class="btn btn-sm btn-primary waves-effect btn-edit" data-toggle="modal" data-target="#editModal" title="Ubah">
                                                <i class="material-icons">edit</i>
                                            </button>
                                            <button type="button" class="btn btn-sm bg-red waves-effect btn-delete" id="<?php echo $akun->id_user; ?>"  data-toggle="modal" data-target="#deleteModal" title="Hapus">
                                                <i class="material-icons">delete</i>
                                            </button>
                                            <button type="button" id="<?= $akun->id_user; ?>" class="btn btn-sm bg-green waves-effect btn-reset-password" data-toggle="modal" data-target="#resetModal" title="Reset Password">
                                                <i class="material-icons">clear</i>
                                            </button>
                                        </td>   
                                    </tr>

                                    <?php $no++;
                                    endforeach;
                                } else { ?>
                                    <tr class="alert alert-danger">
                                        <td colspan="8" align="center">Tidak ada daftar akun.</td>
                                    </tr>   
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>                        
        </div>
    </div>
</div>


<div class="modal fade" id="addAkunModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light-blue">
                <h4 class="modal-title" id="defaultModalLabel">Form Tambah Akun</h4>
            </div>
            <div class="modal-body">
                <form id="vInserValidation" action="<?= base_url('adminroot/pengelolaan_akun/addAkun'); ?>" method="POST">
                    <label>Username</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" name="UsernamePost" class="form-control" placeholder="Masukan Username" autofocus required>
                        </div>
                    </div>
                    <label>Password</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="password" name="PasswordPost" class="form-control" placeholder="Masukan Password" required>
                        </div>
                    </div>
                    <label>Ulangi Password</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="password" name="KonfirmPasswordPost" class="form-control" placeholder="Ulangi Password" required>
                        </div>
                    </div>
                    <label>Hak Akses</label>
                    <div class="form-group">
                        <select class="form-control show-tick" name="HakAksesPost" required>
                            <option value="">-- Pilih Hak Akses --</option>
                            <option value="1">Admin</option>
                            <option value="2">Gudang</option>
                            <option value="3">Kasir</option>
                        </select>
                    </div>
                    <label>Karyawan</label>
                    <div class="form-group">
                        <select class="form-control show-tick" name="AkunKaryawanPost" required>
                            <option value="">-- Pilih Karyawan --</option>
                            <?php foreach ($karyawan as $k) { ?>
                                <option value="<?= $k->id_karyawan; ?>"><?= $k->nama; ?></option>}
                            <?php } ?>
                        </select>
                    </div>
                    <br>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary m-t-15 waves-effect">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light-blue">
                <h4 class="modal-title" id="defaultModalLabel">Form Edit Akun</h4>
            </div>
            <div class="modal-body">
                <form id="vEditValidation" action="<?= base_url('adminroot/Pengelolaan_akun/saveUpdate'); ?>" method="POST">
                    <div class="form-group hidden-xs hidden-sm hidden-ls hidden-md hidden-lg">
                        <div class="form-line">
                            <input type="text" id="idUser" name="idUser" class="form-control">
                        </div>
                    </div>
                    <label>Username</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" id="username" name="username" class="form-control" placeholder="Masukan Username" required>
                        </div>
                    </div>

                    <label>Hak Akses</label>
                    <div class="form-group">
                        <select class="form-control show-tick" id="hakAkses" name="hakAkses" required>
                            <option value="">-- Pilih Hak Akses --</option>
                            <option value="1">Admin</option>
                            <option value="2">Gudang</option>
                            <option value="3">Kasir</option>
                        </select>
                    </div>
                    <label>Karyawan</label>
                    <div class="form-group">
                        <select class="form-control show-tick" id="idKaryawan" name="idKaryawan" required>
                            <option value="">-- Pilih Karyawan --</option>

                            <?php foreach ($listkaryawan as $karyawan) { ?>
                                <option value="<?= $karyawan->id_karyawan ?>"><?= $karyawan->nama; ?></option>
                            <?php } ?>

                            <!-- <?php 
                                foreach ($karyawan as $kar) : ?>
                                    <option value="<?= $kar->id_karyawan ?>"><?= $kar->nama; ?></option>
                            <?php endforeach; ?> -->

                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary m-t-15 waves-effect">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-red">
                <h4 class="modal-title" id="defaultModalLabel">Hapus Akun</h4>
            </div>
            <div class="modal-body">
                <h4 class="h4">Apakah anda yakin akan menghapus <b id="UsernameDel"></b> ? </h4>
            </div>
            <div class="modal-footer">
                <a class="btn bg-red waves-effect hapus">
                    <i class="material-icons">delete</i>
                    <span>Hapus</span>
                </a>
                <a type="button" class="btn waves-effect" data-dismiss="modal">
                    <i class="material-icons">close</i>
                    <span>Close</span>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="resetModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light-blue">
                <h4 class="modal-title" id="defaultModalLabel">Form Reset Password <label id="usernameReset"></label></h4>
            </div>
            <div class="modal-body">
                <form id="form_advance_validation" action="<?= base_url('adminroot/Pengelolaan_akun/saveResetPassword'); ?>" method="POST">
                    <div class="form-group hidden-xs hidden-sm hidden-ls hidden-md hidden-lg">
                        <div class="form-line">
                            <input type="text" id="idUserReset" name="idUserReset" class="form-control" required maxlength="10" minlength="1">
                        </div>
                    </div>

                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="password" name="password" class="form-control" required minlength="6" maxlength="30">
                            <label class="form-label">Password</label>
                        </div>
                        <div class="help-info">Min. 1, Max. 25 karakter</div>
                    </div>

                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="password" name="konfirmPassword" class="form-control" required minlength="6" maxlength="30">
                            <label class="form-label">Ulangi Password</label>
                        </div>
                        <div class="help-info">Min. 1, Max. 25 karakter</div>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary waves-effect">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- #END# Colored Card - With Loading -->



<script>
    
     $('#vInserValidation').validate();
    $('#vEditValidation').validate();
    $('#form_advance_validation').validate();

    // get fine One Update
    $(".btn-edit").click(function(){
        console.log(this.id);
        var idUser = this.id;
        $.post("<?php echo base_url('adminroot/Pengelolaan_akun/editAkun') ?>",
        {
            id: idUser
        },
            function(data, status){
                console.log("Data: " + data + "\nStatus: " + status);
                var data_objek = JSON.parse(data);

                 $("#idUser").val(data_objek.akun[0].id_user);
                 $("#username").val(data_objek.akun[0].username);
                 $("#password").val(data_objek.akun[0].password);
                 $("#konfirmPassword").val(data_objek.akun[0].password);
                 $("#hakAkses").val(data_objek.akun[0].hak_akses).change();
                 $("#idKaryawan").val(data_objek.akun[0].id_karyawan).change();

                 $('#modal_large').modal('toggle');
            });
    });


    // get fine One delete
    $(".btn-delete").click(function(){
        console.log(this.id);
        var idUser = this.id;
        $.post("<?php echo base_url('adminroot/Pengelolaan_akun/editAkun') ?>",
        {
            id: idUser
        },
            function(data, status){
                console.log("Data: " + data + "\nStatus: " + status);
                var data_objek = JSON.parse(data);

                document.getElementById("UsernameDel").innerHTML = data_objek.akun[0].username;
                document.getElementsByClassName("hapus")[0].setAttribute("id",data_objek.akun[0].id_user);
                document.getElementsByClassName("hapus")[0].setAttribute("name",data_objek.akun[0].id_user);
                document.getElementsByClassName("hapus")[0].setAttribute("href","<?php echo base_url('adminroot/Pengelolaan_akun/deleteAkun/') ?>"+data_objek.akun[0].id_user);
                $('#modal_large').modal('toggle');
            });
    });

    $(".btn-reset-password").click(function(){
        console.log(this.id);
        var idUserResetPass = this.id;
        $.post("<?php echo base_url('adminroot/Pengelolaan_akun/editAkun'); ?>",
        {
            id: idUserResetPass
        },
            function(data, status) {
                console.log(data, status);
                var data_objek = JSON.parse(data);

                $("#idUserReset").val(data_objek.akun[0].id_user);
                document.getElementById('usernameReset').innerHTML = data_objek.akun[0].username;
            });
    });


</script>
