<div class="modal fade" id="modalLogin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 class="modal-title" id="exampleModalLabel">********* Login *********</h5>
            </div>
            <div class="modal-body">
                <div id="errorLogin" class="mb-3"></div>
                <form class="user" action="Login/auth_pelanggan" method="POST">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-warning text-white">Email</span>
                            </div>
                            <input placeholder="Email kawan" type="email" id="email" name="email" class="form-control" aria-label="Amount (to the nearest dollar)">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-warning text-white">Password</span>
                            </div>
                            <input placeholder="Password kawan" type="password" id="password" name="user_password" class="form-control" aria-label="Amount (to the nearest dollar)">
                        </div>
                    </div>
            </div>
            <?php $email = session()->get('user_email');
            $role = session()->get('user_role'); ?>
            <?php if ($email && $role == 'pelanggan') : ?>
                <!-- kosong -->
            <?php else : ?>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-text">
                            <b>Belum Punya Akun? </b><a onclick="bukaRegister()" style="cursor: pointer;color:red;">&ensp;Daftar Disini</a>
                        </span>
                    </div>
                </div>
            <?php endif; ?>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="tutupModalLogin()">Batal</button>
                <button type="submit" class="btn btn-warning">Log in</button>
            </div>
            </form>
        </div>
    </div>
</div>