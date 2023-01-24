<div class="login-box">
    <div class="logo">
        <div class="text-center" style="margin-bottom: 20px;">

            <img src="<?= base_url("assets/img/logo_soraya2.png"); ?>" style="width: 250px;">
        </div>
        <small style="color: #555;">Soraya Bedsheet - Pabrik Soraya Bedsheet</small>
    </div>
    <div class="card">
        <div class="body">
            <?php $this->load->view('layouts/_alert'); ?>
            <form id="sign_in" method="POST">
                <div class="msg">Sign in to start your session</div>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">person</i>
                    </span>
                    <div class="form-line">
                        <input type="text" class="form-control" name="username" id="username" value="<?= $input->username ?>" placeholder="Username" required autofocus autocomplete="off">
                    </div>
                </div>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">lock</i>
                    </span>
                    <div class="form-line">
                        <input type="password" class="form-control" name="password" id="password" value="<?= $input->password ?>" placeholder="Password" required>
                    </div>
                </div>
                <div class="row">
                   
                    <div class="col-xs-4" style="float: right;">
                        <button class="btn btn-block bg-deep-orange waves-effect" type="submit">SIGN IN</button>
                    </div>
                </div>
                
            </form>
        </div>
    </div>
</div>