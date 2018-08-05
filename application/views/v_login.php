<div class="login-box">
    <div class="logo">
        <a href="<?= base_url('Login'); ?>"><b>SHOES - POS Management</b></a>
    </div>
    <div class="card">
        <div class="body">
            <form id="sign_in" action="<?= base_url('masuk'); ?>" method="POST">
                <div class="msg">Login</div>

                <?= showFlashMessage(); ?>
                
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">person</i>
                    </span>
                    <div class="form-line">
                        <input type="text" class="form-control" name="userName" placeholder="Username" autofocus>
                    </div>
                </div>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">lock</i>
                    </span>
                    <div class="form-line">
                        <input type="password" class="form-control" name="passWord" placeholder="Password">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-6 col-xs-4">
                        <button class="btn btn-block bg-light-blue waves-effect" type="submit">LOGIN</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
