<!DOCTYPE html>
<html lang="en">
<?php $url = current_url(true); ?>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Cafein | <?= $url->getSegment(3) ?> </title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?= base_url() ?>/public/vendors/feather/feather.css">
    <link rel="stylesheet" href="<?= base_url() ?>/public/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/public/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="<?= base_url() ?>/public/vendors/typicons/typicons.css">
    <link rel="stylesheet" href="<?= base_url() ?>/public/vendors/simple-line-icons/css/simple-line-icons.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="<?= base_url() ?>/public/css/vertical-layout-light/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="<?= base_url() ?>/public/images/<?= $meta['favicon'] ?>" />

    <script src="<?php echo base_url() ?>/public/js/jquery/jquery.min.js"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500&display=swap');
    </style>
</head>

<body>
    <div class="container-scroller">
        <?php include('swal-notice/index.php') ?>
        <!-- partial:../../partials/_navbar.html -->
        <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
                <div class="me-3">
                    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
                        <span class="icon-menu"></span>
                    </button>
                </div>
                <div>
                    <a class="navbar-brand brand-logo text-success fw-bold" href=" ">
                        Admin
                    </a>
                    <a class="navbar-brand brand-logo-mini" href="../../index.html">
                        <img src="<?= base_url() ?>/public/images/logo-mini.svg" alt="logo" />
                    </a>
                </div>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-top">
                <ul class="navbar-nav">
                    <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
                        <h1 class="welcome-text">Hallo <strong style="text-transform:uppercase;"><?= $_SESSION['user_name']; ?>..</strong>, <span class="text-black fw-bold"><?= session()->get("nama") ?></span></h1>
                        <h3 class="welcome-sub-text"> Semoga Hari Ini Lancar</h3>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a type="button" class="text-success fs-1" onclick="bukaPesanMasuk()"><i class="mdi mdi-message"></i><sup id="jumlahPesanMasuk" class="text-success fw-bold fs-6"></sup></a>
                    </li>
                    <li class="nav-item">
                        <a type="button" class="btn btn-social-icon-text btn-dribbble" href="Admin/logout"><i class="mdi mdi-account-check"></i>Log out</a>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
                    <span class="mdi mdi-menu"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial -->
            <!-- partial:../../partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item <?php if ($url->getSegment(3) == "antrian") {
                                            echo "active";
                                        } ?>">
                        <a class="nav-link" href="Admin">
                            <i class="menu-icon mdi mdi-chair-school"></i>
                            <span class="menu-title">Antrian</span>
                        </a>
                    </li>
                    <li class="nav-item <?php if ($url->getSegment(3) == "laporan") {
                                            echo "active";
                                        } ?>">
                        <a class="nav-link" href="Laporan">
                            <i class="menu-icon mdi mdi-book-open-page-variant"></i>
                            <span class="menu-title">Laporan</span>
                        </a>
                    </li>
                    <li class="nav-item nav-category">Data Master</li>
                    <li class="nav-item <?php if ($url->getSegment(3) == "menu") {
                                            echo "active";
                                        } ?>">
                        <a class="nav-link" href="Menu">
                            <i class="menu-icon mdi mdi-food-fork-drink"></i>
                            <span class="menu-title">Menu</span>
                        </a>
                    </li>
                    <?php if (session()->get("user_role") == 'admin') : ?>
                        <li class="nav-item <?php if ($url->getSegment(3) == "user") {
                                                echo "active";
                                            } ?>">
                            <a class="nav-link" href="User">
                                <i class="menu-icon mdi mdi-account"></i>
                                <span class="menu-title">User</span>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if (session()->get("user_role") == 'admin') : ?>
                        <li class="nav-item <?php if ($url->getSegment(3) == "membership") {
                                                echo "active";
                                            } ?>">
                            <a class="nav-link" href="Membership">
                                <i class="menu-icon mdi mdi-account-multiple"></i>
                                <span class="menu-title">Membership</span>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if (session()->get("user_role") == 'admin') : ?>
                        <li class="nav-item <?php if ($url->getSegment(3) == "meta") {
                                                echo "active";
                                            } ?>">
                            <a class="nav-link" href="Meta">
                                <i class="menu-icon mdi mdi-pencil"></i>
                                <span class="menu-title">Edit Meta</span>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <?php $this->renderSection('content'); ?>
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:../../partials/_footer.html -->
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Premium <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from BootstrapDash.</span>
                        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Copyright © 2021. All rights reserved.</span>
                    </div>
                </footer>
            </div>
            <!-- partial -->
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <?php include('modalPesanMasuk/index.php') ?>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        function tutupPesanMasuk() {
            $("#modalPesanMasuk").modal("hide")
        }

        function jumlahPesan() {
            $.ajax({
                type: 'GET',
                url: '<?= base_url() ?>/PesanMasuk/dataPesanMasuk',
                dataType: 'json',
                success: function(data) {
                    var count = 0;

                    if (data) {
                        for (let i = 0; i < data.length; i++) {

                            count++; // Tambahkan hitung data
                        }
                    } else {
                        $("#jumlahPesanMasuk").html('(0)');
                    }

                    if (count >= 100) {
                        $("#jumlahPesanMasuk").html('(99+)');
                    } else {
                        $("#jumlahPesanMasuk").html("(" + count + ")");
                    }
                }
            });
        }
        setInterval(() => {
            jumlahPesan();
        }, 1000);

        function bukaPesanMasuk() {
            $("#modalPesanMasuk").modal('show')
            $.ajax({
                type: 'GET',
                url: '<?= base_url() ?>/PesanMasuk/dataPesanMasuk',
                dataType: 'json',
                success: function(data) {
                    var pesanMasuk = '';

                    for (let i = 0; i < data.length; i++) {
                        pesanMasuk += '<tr>';
                        pesanMasuk += '<td>' + (i + 1) + '</td>';
                        pesanMasuk += '<td>' + data[i].waktu_pesan + '</td>';
                        pesanMasuk += '<td>' + data[i].nama_user + '</td>';
                        pesanMasuk += '<td>' + data[i].email + '</td>';
                        pesanMasuk += '<td>' + data[i].jenis_member + '</td>';
                        pesanMasuk += '<td>' + data[i].bulan + '</td>';
                        if (data[i].status == "tertunda") {
                            pesanMasuk += '<td class="text-danger text-uppercase fw-bold">' + data[i].status + '</td>';
                        } else {
                            pesanMasuk += '<td class="text-success text-uppercase fw-bold">' + data[i].status + '</td>';
                        }
                        pesanMasuk += '<td>' + data[i].waktu_bayar + '</td>';

                        // Tambahkan logika untuk tombol "Sudah Bayar" dan "Terbayar"
                        if (data[i].status === 'terbayar') {
                            pesanMasuk += '<td class="text-center">';
                            pesanMasuk += '<button class="btn btn-danger ml-2" onclick="hapusData(' + data[i].id_pesanMasuk + ')">Delete</button>';
                            pesanMasuk += '</td>';
                        } else {
                            pesanMasuk += '<td>';
                            pesanMasuk += '<button class="btn btn-success" onclick="bayar(' + data[i].id_pesanMasuk + ')">Sudah Bayar</button>';
                            pesanMasuk += '</td>';
                        }

                        pesanMasuk += '</tr>';
                    }

                    $("#tabelPesanMember").html(pesanMasuk);

                }
            });
        }

        function bayar(id_pesanMasuk) {
            // Konfirmasi terlebih dahulu sebelum melakukan pembayaran
            swal({
                    title: "Konfirmasi Pembayaran",
                    text: "Apakah Anda yakin ingin menandai pesan ini sebagai 'Sudah Bayar'?",
                    icon: "warning",
                    buttons: ["Batal", "Ya"],
                    dangerMode: true,
                })
                .then((willPay) => {
                    if (willPay) {
                        // Buat objek data untuk dikirim ke server
                        var data = {
                            id_pesanMasuk: id_pesanMasuk,
                            status: 'terbayar',
                            waktu_bayar: getCurrentDateTime(),
                        };

                        // Kirim permintaan AJAX ke server
                        $.ajax({
                            type: 'POST',
                            url: '<?= base_url() ?>/PesanMasuk/updateStatus',
                            data: data,
                            dataType: 'json',
                            success: function(response) {
                                if (response.success) {
                                    // Jika pembaruan berhasil, tampilkan pesan SweetAlert sukses
                                    swal('Sukses', response.message, 'success').then(() => {
                                        // Refresh data pesanMasuk setelah pembayaran berhasil
                                        bukaPesanMasuk();
                                    });
                                } else {
                                    // Jika pembaruan gagal, tampilkan pesan SweetAlert error
                                    swal('Error', response.message, 'error');
                                }
                            },
                            error: function(error) {
                                // Tangani error lainnya (misalnya, masalah jaringan)
                                console.error('Error:', error);
                                swal('Error', 'Gagal memperbarui status', 'error');
                            }
                        });
                    }
                });
        }

        function getCurrentDateTime() {
            var currentDate = new Date();
            var year = currentDate.getFullYear();
            var month = ('0' + (currentDate.getMonth() + 1)).slice(-2);
            var day = ('0' + currentDate.getDate()).slice(-2);
            var hours = ('0' + currentDate.getHours()).slice(-2);
            var minutes = ('0' + currentDate.getMinutes()).slice(-2);
            var seconds = ('0' + currentDate.getSeconds()).slice(-2);

            // Format yang umum digunakan: YYYY-MM-DD HH:mm:ss
            var formattedDateTime = year + '-' + month + '-' + day + ' ' + hours + ':' + minutes + ':' + seconds;

            return formattedDateTime;
        }

        function hapusData(id_pesanMasuk) {
            // Konfirmasi terlebih dahulu sebelum menghapus data
            swal({
                    title: "Konfirmasi Penghapusan",
                    text: "Apakah Anda yakin ingin menghapus data ini?",
                    icon: "warning",
                    buttons: ["Batal", "Ya"],
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        // Kirim permintaan AJAX ke server untuk menghapus data
                        $.ajax({
                            type: 'POST',
                            url: '<?= base_url() ?>/PesanMasuk/deletePesanMasuk',
                            data: {
                                id_pesanMasuk: id_pesanMasuk
                            },
                            dataType: 'json',
                            success: function(response) {
                                if (response.success) {
                                    // Jika penghapusan berhasil, tampilkan pesan SweetAlert sukses
                                    swal('Sukses', response.message, 'success').then(() => {
                                        // Refresh data pesanMasuk setelah penghapusan berhasil
                                        bukaPesanMasuk();
                                    });
                                } else {
                                    // Jika penghapusan gagal, tampilkan pesan SweetAlert error
                                    swal('Error', response.message, 'error');
                                }
                            },
                            error: function(error) {
                                // Tangani error lainnya (misalnya, masalah jaringan)
                                console.error('Error:', error);
                                swal('Error', 'Gagal menghapus data', 'error');
                            }
                        });
                    }
                });
        }
    </script>

    <!-- endinject -->
    <!-- container-scroller -->
    <!-- plugins:js -->
    <!-- Plugin js for this page -->
    <script src="<?= base_url() ?>/public/vendors/js/vendor.bundle.base.js"></script>
    <script src="<?= base_url() ?>/public/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="<?= base_url() ?>/public/js/off-canvas.js"></script>
    <script src="<?= base_url() ?>/public/js/hoverable-collapse.js"></script>
    <script src="<?= base_url() ?>/public/js/settings.js"></script>
    <script src="<?= base_url() ?>/public/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <!-- End custom js for this page-->

</body>

</html>