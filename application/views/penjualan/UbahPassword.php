<!-- wraping container -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>Pengaturan Profil Pengguna</h2>
            </div>
            
            <?= showFlashMessage(); ?>
            
            <div class="body">
                <form id="form_advanced_validation" action="<?= base_url('penjualan/profile/simpanPassword') ?>" method="POST">
                    <div class="form-group hidden-xs hidden-sm hidden-ls hidden-md hidden-lg">
                        <div class="form-line">
                            <input type="text" name="idUser" class="form-control" value="<?= $akun->id_user; ?>">
                        </div>
                    </div>
                    
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="password" class="form-control" name="password" minlength="6" maxlength="20" required autofocus>
                            <label class="form-label">Password</label>
                        </div>
                        <div class="help-info">Min. 6, max. 20 characters</div>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="password" class="form-control" name="konfirmPass" minlength="6" maxlength="20" required>
                            <label class="form-label">Ulangi Password</label>
                        </div>
                        <div class="help-info">Min. 6, max. 20 characters</div>
                    </div>
                    <button class="btn btn-primary waves-effect" type="submit">Simpan</button>
                    <button type="button" data-toggle="modal" data-target="#modalKembali" title="Batal" class="btn btn-sm bg-red waves-effect">Batal</Button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- #END# Advanced Validation -->

<!-- Modal For Material Design Colors -->
<div class="modal fade" id="modalKembali" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-red">
                <h4 class="modal-title" id="defaultModalLabel">Kembali</h4>
            </div>
            <div class="modal-body">
                Anda yakin akan meninggalkan halaman ini?
            </div>
            <div class="modal-footer">
                <a href="<?= base_url('penjualan/profile/'); ?>" class="btn bg-red waves-effect">
                    <i class="material-icons">check_circle</i>
                    <span>OK</span>
                </a>
                <button type="button" class="btn waves-effect" data-dismiss="modal">
                    <i class="material-icons">close</i>
                    <span>Batal</span>
                </button>
            </div>
        </div>
    </div>
</div>
<!-- End of Modal