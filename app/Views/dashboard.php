<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="<?= $meta['description'] ?>">
    <meta name="keywords" content="<?= $meta['keywords'] ?>">
    <title><?= $meta['title'] ?></title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?= base_url() ?>/public/vendors/feather/feather.css">
    <link rel="stylesheet" href="<?= base_url() ?>/public/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/public/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="<?= base_url() ?>/public/vendors/typicons/typicons.css">
    <link rel="stylesheet" href="<?= base_url() ?>/public/vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="<?= base_url() ?>/public/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="<?= base_url() ?>/public/vendors/font-awesome/css/font-awesome.min.css">
    <!-- endinject -->

    <!-- inject:css -->
    <link rel="stylesheet" href="<?= base_url() ?>/public/css/vertical-layout-light/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="<?= base_url() ?>/public/images/<?= $meta['favicon'] ?>" />

    <!-- Navbar css  -->
    <link rel="stylesheet" href="<?= base_url() ?>/public/css/navbar.css">

    <!-- Footer css  -->
    <link rel="stylesheet" href="<?= base_url() ?>/public/css/footer.css">

    <style>
        .sudahLogin {
            background: green;
            color: #ffffff;
            position: fixed;
            bottom: 0;
            text-align: center;
            z-index: 999;
        }

        .silver {
            background: #bdbdbd;
            color: #000000;
            position: fixed;
            bottom: 0;
            text-align: center;
            z-index: 999;
        }

        .platinum {
            background: #E5E4E2;
            color: #000000;
            position: fixed;
            bottom: 0;
            text-align: center;
            z-index: 999;
        }

        .emas {
            background: linear-gradient(45deg, #ffd700, #ffcc00);
            color: #000000;
            position: relative;
            overflow: hidden;
            position: fixed;
            bottom: 0;
            text-align: center;
            z-index: 999;
        }
    </style>

</head>

<body>
    <div class="container-scroller">

        <?php for ($k = 0; $k < count($membership); $k++) :  ?>
            <?php if (session()->get('user_id') == $membership[$k]['user_id']) { // 
            ?>
                <?php
                // Waktu sekarang 
                date_default_timezone_set('Asia/Jakarta');

                $waktuSekarang = new DateTime();
                $waktuSekarangFormatted = $waktuSekarang->format('Y-m-d H:i:s');

                // Tanggal akhir yang diberikan
                $tglakhir2 = $membership[$k]['sampai'];

                // Ubah format ke objek DateTime
                $tglakhirDateTime2 = new DateTime($tglakhir2);

                // Hitung total detik dari selisih waktu
                $totalDetik = $tglakhirDateTime2->getTimestamp() - $waktuSekarang->getTimestamp();

                $masaAktif = $totalDetik > 0;
                ?>


                <?php if ($membership[$k]['level_member'] == 'SILVER' && $masaAktif) { ?>
                    <p class='col-12 silver'>Member SILVER</p>
                <?php } else if ($membership[$k]['level_member'] == 'PLATINUM' && $masaAktif) { ?>
                    <p class='col-12 platinum'>Member PLATINUM</p>
                <?php } else if ($membership[$k]['level_member'] == 'EMAS' && $masaAktif) { ?>
                    <p class='col-12 emas'>Member Emas</p>
                <?php } ?>
            <?php } ?>
        <?php endfor; ?>

        <!-- Notice swl atau sweet SweetAlert -->
        <?php include('swal-notice/index.php') ?>

        <!-- Navbar include  -->
        <?php include('navbar-front-end/index.php') ?>

        <!-- partial -->
        <div class="container-fluid" style="background: #F4F5F7;">
            <!-- partial -->
            <div class="main-panel" style="margin-left: auto; margin-right: auto;">
                <?php if ($makanan) : ?>
                    <div class="content-wrapper text-center">
                        <h2>Aneka Makanan</h2>
                        <hr>
                        <div class="row">
                            <?php for ($i = 0; $i < count($makanan); $i++) :
                                if ($makanan[$i]["jenis"] == 1) : ?>
                                    <div class="col-lg-3 grid-margin stretch-card">
                                        <div class="card" style="width: 18rem;">
                                            <div class="card-body p-0">
                                                <img height="150px" src="<?= base_url() ?>/public/images/menu/<?= $makanan[$i]["foto"] ?>" class="card-img-top" <?php if ($makanan[$i]["status"] == 0) {
                                                                                                                                                                  echo 'style="filter: grayscale(100%) opacity(0.7); -webkit-filter: grayscale(100%) opacity(0.7);"';
                                                                                                                                                                } ?> alt="...">
                                                <div class="card-body text-center">
                                                    <h5><?= $makanan[$i]["nama"] ?></h5>
                                                    <?php for ($k = 0; $k < count($membership); $k++) :  ?>
                                                        <?php if (session()->get('user_id') == $membership[$k]['user_id']) { // 
                                                        ?>
                                                            <?php
                                                            // Waktu sekarang 
                                                            date_default_timezone_set('Asia/Jakarta');

                                                            $waktuSekarang = new DateTime();
                                                            $waktuSekarangFormatted = $waktuSekarang->format('Y-m-d H:i:s');

                                                            // Tanggal akhir yang diberikan
                                                            $tglakhir2 = $membership[$k]['sampai'];

                                                            // Ubah format ke objek DateTime
                                                            $tglakhirDateTime2 = new DateTime($tglakhir2);

                                                            // Hitung total detik dari selisih waktu
                                                            $totalDetik = $tglakhirDateTime2->getTimestamp() - $waktuSekarang->getTimestamp();

                                                            $masaAktif = $totalDetik > 0;
                                                            ?>


                                                            <?php if ($membership[$k]['level_member'] == 'SILVER' && $masaAktif) { ?>
                                                                <i><s>Rp. <?= $makanan[$i]["harga"] ?></s></i><br>
                                                                <?php
                                                                $diskon = 5; //%
                                                                $nilai_diskon = ($diskon / 100) * $makanan[$i]["harga"];
                                                                $harga_akhir = $makanan[$i]["harga"] - $nilai_diskon;
                                                                ?>
                                                                <b style="background: wheat;">Rp. <?= $harga_akhir ?></b>
                                                            <?php } else if ($membership[$k]['level_member'] == 'PLATINUM' && $masaAktif) { ?>
                                                                <i><s>Rp. <?= $makanan[$i]["harga"] ?></s></i><br>
                                                                <?php
                                                                $diskon = 10; //%
                                                                $nilai_diskon = ($diskon / 100) * $makanan[$i]["harga"];
                                                                $harga_akhir = $makanan[$i]["harga"] - $nilai_diskon;
                                                                ?>
                                                                <b style="background: wheat;">Rp. <?= $harga_akhir ?></b>
                                                            <?php } else if ($membership[$k]['level_member'] == 'EMAS' && $masaAktif) { ?>
                                                                <i><s>Rp. <?= $makanan[$i]["harga"] ?></s></i><br>
                                                                <?php
                                                                $diskon = 15; //%
                                                                $nilai_diskon = ($diskon / 100) * $makanan[$i]["harga"];
                                                                $harga_akhir = $makanan[$i]["harga"] - $nilai_diskon;
                                                                ?>
                                                                <b style="background: wheat;">Rp. <?= $harga_akhir ?></b>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    <?php endfor; ?>

                                                    <?php $nomember = 0 ?>
                                                    <?php for ($k = 0; $k < count($membership); $k++) :  ?>
                                                        <?php if ($membership[$k]['user_id'] == session()->get('user_id') && $masaAktif) { ?>
                                                            <?php $nomember = 1; ?>
                                                        <?php } ?>
                                                    <?php endfor; ?>

                                                    <?php if ($nomember == 0) : ?>
                                                        <i>Rp. <?= $makanan[$i]["harga"] ?></i>
                                                    <?php endif; ?>

                                                    <br>
                                                    <?php
                                                    $email = session()->get('user_email');
                                                    $role = session()->get('user_role');
                                                    ?>
                                                    <?php if ($email && $role == 'pelanggan') : ?>
                                                        <button class="btn btn-warning btn-sm btn-fw mt-2" <?php if ($makanan[$i]["status"] == 0) {
                                                                                                                echo "disabled";
                                                                                                            } ?> onclick='tambahPesanan(<?= $makanan[$i]["id"] ?>, "<?= $makanan[$i]["nama"] ?>", <?= $makanan[$i]["harga"] ?> )'><?php if ($makanan[$i]["status"] == 0) {
                                                                                                                                                                                                                                        echo "Habis";
                                                                                                                                                                                                                                    } else {
                                                                                                                                                                                                                                        echo "Tambah";
                                                                                                                                                                                                                                    } ?></button>
                                                    <?php else : ?>
                                                        <style>
                                                            @keyframes blink {
                                                                0% {
                                                                    opacity: 1;
                                                                }

                                                                50% {
                                                                    opacity: 0;
                                                                }

                                                                100% {
                                                                    opacity: 1;
                                                                }
                                                            }

                                                            .blink-text {
                                                                animation: blink 1s infinite;
                                                            }
                                                        </style>
                                                        <h6 class="text-capitalize blink-text text-danger">Login Dulu..</h6>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            <?php
                                endif;
                            endfor; ?>
                        </div>
                    </div>
                <?php endif;
                if ($snack) : ?>

                    <div class="content-wrapper text-center">
                        <h2>Aneka Snack</h2>
                        <hr>
                        <div class="row">
                            <?php for ($i = 0; $i < count($snack); $i++) :
                                if ($snack[$i]["jenis"] == 2) : ?>
                                    <div class="col-lg-3 grid-margin stretch-card">
                                        <div class="card" style="width: 18rem;">
                                            <div class="card-body p-0">
                                                <img height="150px" src="<?= base_url() ?>/public/images/menu/<?= $snack[$i]["foto"] ?>" class="card-img-top" <?php if ($snack[$i]["status"] == 0) {
                                                                                                                                                                   echo 'style="filter: grayscale(100%) opacity(0.7); -webkit-filter: grayscale(100%) opacity(0.7);"';
                                                                                                                                                                } ?> alt="...">
                                                <div class="card-body text-center">
                                                    <h5><?= $snack[$i]["nama"] ?></h5>
                                                    <?php for ($k = 0; $k < count($membership); $k++) :  ?>
                                                        <?php if (session()->get('user_id') == $membership[$k]['user_id']) { // 
                                                        ?>
                                                            <?php
                                                            // Waktu sekarang 
                                                            date_default_timezone_set('Asia/Jakarta');

                                                            $waktuSekarang = new DateTime();
                                                            $waktuSekarangFormatted = $waktuSekarang->format('Y-m-d H:i:s');

                                                            // Tanggal akhir yang diberikan
                                                            $tglakhir2 = $membership[$k]['sampai'];

                                                            // Ubah format ke objek DateTime
                                                            $tglakhirDateTime2 = new DateTime($tglakhir2);

                                                            // Hitung total detik dari selisih waktu
                                                            $totalDetik = $tglakhirDateTime2->getTimestamp() - $waktuSekarang->getTimestamp();

                                                            $masaAktif = $totalDetik > 0;
                                                            ?>


                                                            <?php if ($membership[$k]['level_member'] == 'SILVER' && $masaAktif) { ?>
                                                                <i><s>Rp. <?= $snack[$i]["harga"] ?></s></i><br>
                                                                <?php
                                                                $diskon = 5; //%
                                                                $nilai_diskon = ($diskon / 100) * $snack[$i]["harga"];
                                                                $harga_akhir = $snack[$i]["harga"] - $nilai_diskon;
                                                                ?>
                                                                <b style="background: wheat;">Rp. <?= $harga_akhir ?></b>
                                                            <?php } else if ($membership[$k]['level_member'] == 'PLATINUM' && $masaAktif) { ?>
                                                                <i><s>Rp. <?= $snack[$i]["harga"] ?></s></i><br>
                                                                <?php
                                                                $diskon = 10; //%
                                                                $nilai_diskon = ($diskon / 100) * $snack[$i]["harga"];
                                                                $harga_akhir = $snack[$i]["harga"] - $nilai_diskon;
                                                                ?>
                                                                <b style="background: wheat;">Rp. <?= $harga_akhir ?></b>
                                                            <?php } else if ($membership[$k]['level_member'] == 'EMAS' && $masaAktif) { ?>
                                                                <i><s>Rp. <?= $snack[$i]["harga"] ?></s></i><br>
                                                                <?php
                                                                $diskon = 15; //%
                                                                $nilai_diskon = ($diskon / 100) * $snack[$i]["harga"];
                                                                $harga_akhir = $snack[$i]["harga"] - $nilai_diskon;
                                                                ?>
                                                                <b style="background: wheat;">Rp. <?= $harga_akhir ?></b>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    <?php endfor; ?>

                                                    <?php $nomember = 0 ?>
                                                    <?php for ($k = 0; $k < count($membership); $k++) :  ?>
                                                        <?php if ($membership[$k]['user_id'] == session()->get('user_id') && $masaAktif) { ?>
                                                            <?php $nomember = 1; ?>
                                                        <?php } ?>
                                                    <?php endfor; ?>

                                                    <?php if ($nomember == 0) : ?>
                                                        <i>Rp. <?= $snack[$i]["harga"] ?></i>
                                                    <?php endif; ?>
                                                    <br>

                                                    <?php
                                                    $email = session()->get('user_email');
                                                    $role = session()->get('user_role');
                                                    ?>
                                                    <?php if ($email && $role == 'pelanggan') : ?>
                                                        <button class="btn btn-warning btn-sm btn-fw mt-2" <?php if ($snack[$i]["status"] == 0) {
                                                                                                                echo "disabled";
                                                                                                            } ?> onclick='tambahPesanan(<?= $snack[$i]["id"] ?>, "<?= $snack[$i]["nama"] ?>", <?= $snack[$i]["harga"] ?> )'><?php if ($snack[$i]["status"] == 0) {
                                                                                                                                                                                                                                echo "Habis";
                                                                                                                                                                                                                            } else {
                                                                                                                                                                                                                                echo "Tambah";
                                                                                                                                                                                                                            } ?></button>
                                                    <?php else : ?>
                                                        <style>
                                                            @keyframes blink {
                                                                0% {
                                                                    opacity: 1;
                                                                }

                                                                50% {
                                                                    opacity: 0;
                                                                }

                                                                100% {
                                                                    opacity: 1;
                                                                }
                                                            }

                                                            .blink-text {
                                                                animation: blink 1s infinite;
                                                            }
                                                        </style>
                                                        <h6 class="text-capitalize blink-text text-danger">Login Dulu..</h6>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            <?php
                                endif;
                            endfor; ?>
                        </div>
                    </div>
                <?php endif;
                if ($minumanDingin) : ?>

                    <div class="content-wrapper text-center">
                        <h2>Aneka Minuman Dingin</h2>
                        <hr>
                        <div class="row">
                            <?php for ($i = 0; $i < count($minumanDingin); $i++) :
                                if ($minumanDingin[$i]["jenis"] == 3) : ?>
                                    <div class="col-lg-3 grid-margin stretch-card">
                                        <div class="card" style="width: 18rem;">
                                            <div class="card-body p-0">
                                                <img height="150px" src="<?= base_url() ?>/public/images/menu/<?= $minumanDingin[$i]["foto"] ?>" class="card-img-top" <?php if ($minumanDingin[$i]["status"] == 0) {
                                                                                                                                                                           echo 'style="filter: grayscale(100%) opacity(0.7); -webkit-filter: grayscale(100%) opacity(0.7);"';
                                                                                                                                                                        } ?> alt="...">
                                                <div class="card-body text-center">
                                                    <h5><?= $minumanDingin[$i]["nama"] ?></h5>
                                                    <?php for ($k = 0; $k < count($membership); $k++) :  ?>
                                                        <?php if (session()->get('user_id') == $membership[$k]['user_id']) { // 
                                                        ?>
                                                            <?php
                                                            // Waktu sekarang 
                                                            date_default_timezone_set('Asia/Jakarta');

                                                            $waktuSekarang = new DateTime();
                                                            $waktuSekarangFormatted = $waktuSekarang->format('Y-m-d H:i:s');

                                                            // Tanggal akhir yang diberikan
                                                            $tglakhir2 = $membership[$k]['sampai'];

                                                            // Ubah format ke objek DateTime
                                                            $tglakhirDateTime2 = new DateTime($tglakhir2);

                                                            // Hitung total detik dari selisih waktu
                                                            $totalDetik = $tglakhirDateTime2->getTimestamp() - $waktuSekarang->getTimestamp();

                                                            $masaAktif = $totalDetik > 0;
                                                            ?>


                                                            <?php if ($membership[$k]['level_member'] == 'SILVER' && $masaAktif) { ?>
                                                                <i><s>Rp. <?= $minumanDingin[$i]["harga"] ?></s></i><br>
                                                                <?php
                                                                $diskon = 5; //%
                                                                $nilai_diskon = ($diskon / 100) * $minumanDingin[$i]["harga"];
                                                                $harga_akhir = $minumanDingin[$i]["harga"] - $nilai_diskon;
                                                                ?>
                                                                <b style="background: wheat;">Rp. <?= $harga_akhir ?></b>
                                                            <?php } else if ($membership[$k]['level_member'] == 'PLATINUM' && $masaAktif) { ?>
                                                                <i><s>Rp. <?= $minumanDingin[$i]["harga"] ?></s></i><br>
                                                                <?php
                                                                $diskon = 10; //%
                                                                $nilai_diskon = ($diskon / 100) * $minumanDingin[$i]["harga"];
                                                                $harga_akhir = $minumanDingin[$i]["harga"] - $nilai_diskon;
                                                                ?>
                                                                <b style="background: wheat;">Rp. <?= $harga_akhir ?></b>
                                                            <?php } else if ($membership[$k]['level_member'] == 'EMAS' && $masaAktif) { ?>
                                                                <i><s>Rp. <?= $minumanDingin[$i]["harga"] ?></s></i><br>
                                                                <?php
                                                                $diskon = 15; //%
                                                                $nilai_diskon = ($diskon / 100) * $minumanDingin[$i]["harga"];
                                                                $harga_akhir = $minumanDingin[$i]["harga"] - $nilai_diskon;
                                                                ?>
                                                                <b style="background: wheat;">Rp. <?= $harga_akhir ?></b>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    <?php endfor; ?>

                                                    <?php $nomember = 0 ?>
                                                    <?php for ($k = 0; $k < count($membership); $k++) :  ?>
                                                        <?php if ($membership[$k]['user_id'] == session()->get('user_id') && $masaAktif) { ?>
                                                            <?php $nomember = 1; ?>
                                                        <?php } ?>
                                                    <?php endfor; ?>

                                                    <?php if ($nomember == 0) : ?>
                                                        <i>Rp. <?= $minumanDingin[$i]["harga"] ?></i>
                                                    <?php endif; ?>
                                                    <br>

                                                    <?php
                                                    $email = session()->get('user_email');
                                                    $role = session()->get('user_role');
                                                    ?>
                                                    <?php if ($email && $role == 'pelanggan') : ?>
                                                        <button class="btn btn-warning btn-sm btn-fw mt-2" <?php if ($minumanDingin[$i]["status"] == 0) {
                                                                                                                echo "disabled";
                                                                                                            } ?> onclick='tambahPesanan(<?= $minumanDingin[$i]["id"] ?>, "<?= $minumanDingin[$i]["nama"] ?>", <?= $minumanDingin[$i]["harga"] ?> )'><?php if ($minumanDingin[$i]["status"] == 0) {
                                                                                                                                                                                                                                                        echo "Habis";
                                                                                                                                                                                                                                                    } else {
                                                                                                                                                                                                                                                        echo "Tambah";
                                                                                                                                                                                                                                                    } ?></button>
                                                    <?php else : ?>
                                                        <style>
                                                            @keyframes blink {
                                                                0% {
                                                                    opacity: 1;
                                                                }

                                                                50% {
                                                                    opacity: 0;
                                                                }

                                                                100% {
                                                                    opacity: 1;
                                                                }
                                                            }

                                                            .blink-text {
                                                                animation: blink 1s infinite;
                                                            }
                                                        </style>
                                                        <h6 class="text-capitalize blink-text text-danger">Login Dulu..</h6>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            <?php
                                endif;
                            endfor; ?>
                        </div>
                    </div>
                <?php endif;
                if ($minumanPanas) : ?>

                    <div class="content-wrapper text-center">
                        <h2>Aneka Minuman Panas</h2>
                        <hr>
                        <div class="row">
                            <?php for ($i = 0; $i < count($minumanPanas); $i++) :
                                if ($minumanPanas[$i]["jenis"] == 4) : ?>
                                    <div class="col-lg-3 grid-margin stretch-card">
                                        <div class="card" style="width: 18rem;">
                                            <div class="card-body p-0">
                                                <img height="150px" src="<?= base_url() ?>/public/images/menu/<?= $minumanPanas[$i]["foto"] ?>" class="card-img-top" <?php if ($minumanPanas[$i]["status"] == 0) {
                                                                                                                                                                           echo 'style="filter: grayscale(100%) opacity(0.7); -webkit-filter: grayscale(100%) opacity(0.7);"';
                                                                                                                                                                        } ?> alt="...">
                                                <div class="card-body text-center">
                                                    <h5><?= $minumanPanas[$i]["nama"] ?></h5>
                                                    <?php for ($k = 0; $k < count($membership); $k++) :  ?>
                                                        <?php if (session()->get('user_id') == $membership[$k]['user_id']) { // 
                                                        ?>
                                                            <?php
                                                            // Waktu sekarang 
                                                            date_default_timezone_set('Asia/Jakarta');

                                                            $waktuSekarang = new DateTime();
                                                            $waktuSekarangFormatted = $waktuSekarang->format('Y-m-d H:i:s');

                                                            // Tanggal akhir yang diberikan
                                                            $tglakhir2 = $membership[$k]['sampai'];

                                                            // Ubah format ke objek DateTime
                                                            $tglakhirDateTime2 = new DateTime($tglakhir2);

                                                            // Hitung total detik dari selisih waktu
                                                            $totalDetik = $tglakhirDateTime2->getTimestamp() - $waktuSekarang->getTimestamp();

                                                            $masaAktif = $totalDetik > 0;
                                                            ?>


                                                            <?php if ($membership[$k]['level_member'] == 'SILVER' && $masaAktif) { ?>
                                                                <i><s>Rp. <?= $minumanPanas[$i]["harga"] ?></s></i><br>
                                                                <?php
                                                                $diskon = 5; //%
                                                                $nilai_diskon = ($diskon / 100) * $minumanPanas[$i]["harga"];
                                                                $harga_akhir = $minumanPanas[$i]["harga"] - $nilai_diskon;
                                                                ?>
                                                                <b style="background: wheat;">Rp. <?= $harga_akhir ?></b>
                                                            <?php } else if ($membership[$k]['level_member'] == 'PLATINUM' && $masaAktif) { ?>
                                                                <i><s>Rp. <?= $minumanPanas[$i]["harga"] ?></s></i><br>
                                                                <?php
                                                                $diskon = 10; //%
                                                                $nilai_diskon = ($diskon / 100) * $minumanPanas[$i]["harga"];
                                                                $harga_akhir = $minumanPanas[$i]["harga"] - $nilai_diskon;
                                                                ?>
                                                                <b style="background: wheat;">Rp. <?= $harga_akhir ?></b>
                                                            <?php } else if ($membership[$k]['level_member'] == 'EMAS' && $masaAktif) { ?>
                                                                <i><s>Rp. <?= $minumanPanas[$i]["harga"] ?></s></i><br>
                                                                <?php
                                                                $diskon = 15; //%
                                                                $nilai_diskon = ($diskon / 100) * $minumanPanas[$i]["harga"];
                                                                $harga_akhir = $minumanPanas[$i]["harga"] - $nilai_diskon;
                                                                ?>
                                                                <b style="background: wheat;">Rp. <?= $harga_akhir ?></b>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    <?php endfor; ?>

                                                    <?php $nomember = 0 ?>
                                                    <?php for ($k = 0; $k < count($membership); $k++) :  ?>
                                                        <?php if ($membership[$k]['user_id'] == session()->get('user_id') && $masaAktif) { ?>
                                                            <?php $nomember = 1; ?>
                                                        <?php } ?>
                                                    <?php endfor; ?>

                                                    <?php if ($nomember == 0) : ?>
                                                        <i>Rp. <?= $minumanPanas[$i]["harga"] ?></i>
                                                    <?php endif; ?>
                                                    <br>

                                                    <?php $email = session()->get('user_email');
                                                    $role = session()->get('user_role'); ?>
                                                    <?php if ($email && $role == 'pelanggan') : ?>
                                                        <button class="btn btn-warning btn-sm btn-fw mt-2" <?php if ($minumanPanas[$i]["status"] == 0) {
                                                                                                                echo "disabled";
                                                                                                            } ?> onclick='tambahPesanan(
                                    <?= $minumanPanas[$i]["id"] ?>, "<?= $minumanPanas[$i]["nama"] ?>", 
                                    <?= $minumanPanas[$i]["harga"] ?> )'>
                                                            <?php if ($minumanPanas[$i]["status"] == 0) {
                                                                echo "Habis";
                                                            } else {
                                                                echo "Tambah";
                                                            } ?>
                                                        </button>
                                                    <?php else : ?>
                                                        <style>
                                                            @keyframes blink {
                                                                0% {
                                                                    opacity: 1;
                                                                }

                                                                50% {
                                                                    opacity: 0;
                                                                }

                                                                100% {
                                                                    opacity: 1;
                                                                }
                                                            }

                                                            .blink-text {
                                                                animation: blink 1s infinite;
                                                            }
                                                        </style>
                                                        <h6 class="text-capitalize blink-text text-danger">Login Dulu..</h6>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            <?php
                                endif;
                            endfor; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Modal Keranjang -->
                <?php include('modalKeranjang/index.php') ?>

                <!-- Modal Order  -->
                <?php include('modalOrder/index.php') ?>
                <!-- End Modal Order  -->

                <!-- Modal Selesai-->
                <?php include('modalSelesai/index.php') ?>

                <!-- Register Modal  -->
                <?php include('modalRegister/index.php') ?>
                <!-- End Register Modal  -->

                <!-- Modal Login -->
                <?php include('modalLogin/index.php') ?>
                <!-- end Modal Login  -->

                <!-- Modal Menu Favorit  -->
                <?php include('modalMenuFavorit/index.php') ?>
                <!-- end Modal Menu Favorit  -->

                <!-- Modal Menu Favorit  -->
                <?php include('modalStatusMember/index.php') ?>
                <!-- end Modal Menu Favorit  -->

                <!-- main-panel ends -->
            </div>
            <!-- page-body-wrapper ends -->
        </div>

        <!-- Footer page include  -->
        <?php include('footer/index.php') ?>

        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

        <?php
        // jika sudah login maka akan muncul code untuk handle produk yang sudah dipesan yakni icon samping keranjang 
        if (session()->get('user_id')) {
            include('Order-js/index.php');
        }
        ?>
        <script>
            function bukaModalLogin() {
                $("#modalLogin").modal("show");
                $('#RegisterModal').modal('hide');
            }

            function kriteriaPassword(password) {
                // Ekspresi reguler untuk memeriksa apakah password memenuhi kriteria
                const passwordRegex = /^(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])/;

                return passwordRegex.test(password);
            }

            function isValidEmail(email) {
                // Ekspresi reguler untuk memeriksa validitas alamat email
                const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

                return emailRegex.test(email);
            }

            function Register() {
                if ($("#name").val() == "") {
                    swal("Error", "Mohon isi Nama terlebih dahulu.", "error");
                    $("#name").focus();
                } else if (!isValidEmail($("#email").val())) {
                    swal("Error", "Format Email tidak valid. Mohon periksa kembali.", "error");
                    $("#email").focus();
                } else if (!kriteriaPassword($("#password").val())) {
                    swal("Error", "Password harus huruf besar pertama, terdiri dari angka dan simbol.", "error");
                    $("#password").focus();
                } else if ($('#password').val() != $('#ulangiPassword').val()) {
                    swal("Error", "Ulangi password yang benar", "error");
                    $("#ulangiPassword").focus();
                } else {
                    $.ajax({
                        type: 'POST',
                        data: 'user_name=' + $("#name").val() + '&user_email=' + $("#email").val() + '&user_password=' + $("#password").val() + '&user_role=' + $("#role").val(),
                        url: '<?= base_url() ?>/Register/daftar_pelanggan',
                        dataType: 'json',
                        success: function(data) {
                            if (data.error) {
                                // Ada kesalahan, tampilkan pesan kesalahan
                                swal("Error", data.error, "error");
                            } else {
                                // Tidak ada kesalahan, bersihkan input dan tutup modal
                                $("#name").val("");
                                $("#email").val("");
                                $("#password").val("");
                                $("#role").val("");
                                $("#ulangiPassword").val("");
                                $("#modalLogin").modal("show");
                                $('#RegisterModal').modal('hide');
                                swal("Success", data.success, "success");
                            }
                        },
                        error: function(xhr, status, error) {
                            swal("Error", "Terjadi kesalahan saat menambah member: " + error, "error");
                        }

                    });
                }
            }

            function bukaModalKeranjang() {
                tampilkanPesanan()
                $("#modalKeranjang").modal("show")
                $("#peringatan").hide()
            }

            function bukaRegister() {
                $('#RegisterModal').modal('show');
                $("#modalLogin").modal('hide');
            }


            function tutupModalKeranjang() {
                $("#modalKeranjang").modal("hide")
            }


            function tutupModalSelesai() {
                $("#modalSelesai").modal("hide")
            }

            function tutupModalLogin() {
                $("#modalLogin").modal("hide");
            }

            function tutupModalRegister() {
                $('#RegisterModal').modal('hide');
            }
        </script>

        <script src="<?= base_url() ?>/public/vendors/js/vendor.bundle.base.js"></script>
        <script src="<?= base_url() ?>/public/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
        <script src="<?= base_url() ?>/public/js/off-canvas.js"></script>
        <script src="<?= base_url() ?>/public/js/hoverable-collapse.js"></script>
        <script src="<?= base_url() ?>/public/js/template.js"></script>
        <script src="<?= base_url() ?>/public/js/settings.js"></script>
        <script src="<?= base_url() ?>/public/js/todolist.js"></script>
        <!-- endinject -->

        <!-- Vendor JS Files -->
        <script src="vendor/aos/aos.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="vendor/glightbox/js/glightbox.min.js"></script>
        <script src="vendor/isotope-layout/isotope.pkgd.min.js"></script>
        <script src="vendor/swiper/swiper-bundle.min.js"></script>
        <script src="vendor/waypoints/noframework.waypoints.js"></script>
        <script src="vendor/php-email-form/validate.js"></script>

        <!-- jQuery dan Bootstrap JavaScript -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <!-- untuk dorpdown  -->

        <!-- Navbar js  -->
        <script src="<?= base_url() ?>/public/js/navbar/main.js"></script>

</body>

</html>