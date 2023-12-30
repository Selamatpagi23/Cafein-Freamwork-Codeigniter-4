<div class="modal fade" id="RegisterModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 class="modal-title" id="exampleModalLabel">********* Register *********</h5>
            </div>
            <div class="modal-body">
                <form class="user" action="Register/daftar_pelanggan" method="POST">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-warning text-white">Your Name</span>
                            </div>
                            <input placeholder="Full Name" type="text" id="name" name="user_name" class="form-control" aria-label="Amount (to the nearest dollar)">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-warning text-white">Your Email</span>
                            </div>
                            <input placeholder="Email kawan" type="email" id="email" name="user_email" class="form-control" aria-label="Amount (to the nearest dollar)">
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
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-warning text-white">Password</span>
                            </div>
                            <input placeholder="Repeat Password" type="password" id="ulangiPassword" name="confpassword" class="form-control" aria-label="Amount (to the nearest dollar)">
                        </div>
                    </div>
            </div>
            <input type="hidden" class="form-control" id="role" placeholder="Role" name="user_role" value="pelanggan">
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-text">
                        <b>Sudah Punya Akun? </b><a onclick="bukaModalLogin()" style="cursor: pointer;color:red;">&ensp;Login Disini</a>
                    </span>
                </div>
            </div>
            </form>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="tutupModalRegister()">Batal</button>
                <button type="button" class="btn btn-warning" onclick="Register()">Register Now</button>
            </div>

        </div>
    </div>
</div>