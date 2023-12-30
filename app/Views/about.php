<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="<?= $meta['description'] ?>">
    <meta name="keywords" content="<?= $meta['keywords'] ?>">
    <title>About</title>
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

    <!-- About css  -->
    <link rel="stylesheet" href="<?= base_url() ?>/public/css/about.css">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" />
    <link rel="stylesheet" href="<?= base_url() ?>/public/about/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>/public/about/css/templatemo-style.css" />

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

        <!-- Penanda sudah login  -->
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


        <!-- Navbar page include  -->
        <?php include('navbar-front-end/index.php') ?>

        <!-- Main page about  -->
        <!-- Welcome Section -->
        <section id="tmWelcome" class="parallax-window" data-parallax="scroll" data-image-src="<?= base_url() ?>/public/about/img/wallpapermie-01.jpg">
            <div class="container-fluid tm-brand-container-outer">
                <div class="row">
                    <div class="col-12">
                        <!-- Logo Area -->
                        <!-- Black transparent bg -->
                        <div class="ml-auto mr-0 tm-bg-black-transparent text-white tm-brand-container-inner">
                            <div class="tm-brand-container text-center">
                                <h1 class="tm-brand-name">Like Mie & Coffe</h1>
                                <p class="tm-brand-description mb-0">Mie dengan Cinta, Hanya di Like Mie & Coffee.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tm-bg-white-transparent tm-welcome-container">
                <div class="container-fluid">
                    <div class="row h-100">
                        <!-- Welcome Text -->
                        <!-- White transparent bg -->
                        <div class="col-md-7 tm-welcome-left-col">
                            <div class="tm-welcome-left">
                                <h2 class="tm-welcome-title">Like Mie & Coffe</h2>
                                <p class="pb-0">
                                    Selamat datang di Like Mie & Coffe, tempat di mana kreasi mie lezat bertemu dengan inovasi. Tetapi, jangan lupakan kenyamanan dan suasana santai kami Like Mie juga adalah tempat ideal untuk bersantai sambil menikmati secangkir kopi yang segar.
                            </div>
                        </div>
                        <!-- Brown bg -->
                        <div class="col-md-5">
                                
                            <img src="<?= base_url() ?>/public/about/img/MieUdang1.jpg" alt="" width="450" height="400">
                                 
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Welcome section -->

        <!-- section -->
        <script src="<?= base_url() ?>/public/about/js/jquery.min.js"></script>
        <script src="<?= base_url() ?>/public/about/js/parallax.min.js"></script>
        <script>
            function detectMsBrowser() {
                using_ms_browser =
                    navigator.appName == "Microsoft Internet Explorer" ||
                    (navigator.appName == "Netscape" &&
                        navigator.appVersion.indexOf("Edge") > -1) ||
                    (navigator.appName == "Netscape" &&
                        navigator.appVersion.indexOf("Trident") > -1);

                if (using_ms_browser == true) {
                    alert(
                        "Please use Chrome or Firefox for the best browsing experience!"
                    );
                }
            }

            function setBrandMarginTop() {
                var bottomContainerHeight = $(".tm-welcome-container").height();

                $(".tm-brand-container-outer").css({
                    "margin-top": -bottomContainerHeight + "px"
                });
            }

            $(function() {
                setBrandMarginTop();
                detectMsBrowser();

                // Handle window resize event
                $(window).resize(function() {
                    setBrandMarginTop();
                });
            });
        </script>
        <!-- End page abotu  -->

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