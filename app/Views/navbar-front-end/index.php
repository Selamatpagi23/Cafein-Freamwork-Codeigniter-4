<!-- Fixed navbar -->
<nav class="navbar navbar-expand-lg navbar-light col-lg-12 p-2 col-12 fixed-top">
    <div class="container">
        <a class="navbar-brand" href="/"><img src="<?= base_url() ?>/public/images/<?= $meta['logo'] ?>" alt="logo" width="50px"></a>

        <!-- Icon Tas untuk menampung pembelia pelanggan  -->
        <?php
        $email = session()->get('user_email');
        $role = session()->get('user_role');

        ?>
        <?php if ($email && $role == 'pelanggan') : ?>
            <a onclick="bukaModalKeranjang()" class="btn d-flex align-items-center" style="color:green;"><i style="font-size:25px;" class="mdi mdi-cart-outline"></i><sup id="jmlPesanan" class="text-success fw-bold fs-6"></sup></a>

            <a onclick="bukaOrder()" class="btn d-flex align-items-center" style="color:red;"><i style="font-size:25px;" class="mdi mdi-chef-hat"></i><sup id="jmlOrder" class="text-success fw-bold fs-6"></sup></a>
        <?php endif; ?>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain" aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation" style="border:none;color:red;background:transparent">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarMain">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link text-dark" aria-current="page" href="Dashboard">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="About">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="Location">Location</a>
                </li>
                <li class="nav-item dropdown">
                    <?php
                    $email = session()->get('user_email');
                    $role = session()->get('user_role');

                    ?>
                    <?php if ($email && $role == 'pelanggan') : ?>
                        <button class="btn dropdown-toggle" style="background:green;color:#fff;" type="button" id="userDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-user"></i><span class="text-capitalize">&ensp;<?= session()->get('user_name'); ?></span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right mt-2" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="#" onclick="bukaInfoMember()"><i class="fa fa-info"></i>&ensp;Status Member </a>
                            <a class="dropdown-item" href="#" onclick="bukaMenuFavorit()"><i class="fa fa-cutlery"></i>&ensp;Menu Favorit </a>
                            <a class="dropdown-item" href="#" onclick="bukaModalLogin()"><i class="fa fa-sign-in"></i>&ensp;Ganti Akun </a>
                            <a class="dropdown-item" href="<?= base_url('/Login/logout'); ?>"><i class="fa fa-power-off">&ensp;</i> Logout</a>
                        </div>

                    <?php else : ?>
                <li class="loginUser">
                    <a onclick="bukaModalLogin()">Login</a>
                </li>
            <?php endif; ?>
            </li>
            </ul>
        </div>
    </div>
</nav>