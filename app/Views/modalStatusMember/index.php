<!-- modal mennu Favorit  -->
<div class="modal fade" id="modalStatusMember" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <h5 class="modal-title text-center p-3" id="exampleModalLabel">********* Status Member *********</h5>
            <div class="modal-body">
                <?php if (session()->get('user_id')) : ?>

                    <?php foreach ($pesanMasuk as $pesan) { ?>
                        <?php if ($pesan['user_id'] == session()->get('user_id') && $pesan['status'] == 'tertunda') { ?>
                            <h4 class="text-danger">
                                <center>Sedang Dalam Pengajuan..</center>
                            </h4>
                            <p>Waktu Pengajuan : <?php echo $pesan['waktu_pesan'] ?></p>
                            <p>Pilihan Member : <?php echo $pesan['jenis_member'] ?></p>
                            <p>Masa Aktif : <?php echo $pesan['bulan'] ?></p>
                            <p>Status : <span class="text-warning fw-bold text-uppercase"><?php echo $pesan['status'] ?></span></p>
                            <p><strong class="text-danger">*Selesaikan Pembayaran Untuk Mengaktifkan Member..!</strong></p>
                        <?php }  ?>
                    <?php } ?>

                    <?php
                    $memberFound = false;

                    foreach ($membership as $member) {
                        if ($member['user_id'] == session()->get('user_id')) {
                            $memberFound = true;
                    ?>
                            <div class="card">
                                <div class="card-body" style="border: dotted #000 3px;border-radius:5px; ">
                                    <p><strong class="text-success">*Terimakasih, Selamat Menikmati Harga Sepcial..!</strong></p>
                                    <h5 class="card-title">Telah Aktif Sebagai Member <?php echo $member['level_member'] ?></h5>
                                    <p class="card-text">Masa Aktif Sampai : <span class="text-success fw-bold"><?php echo $member['sampai'] ?></span></p>
                                </div>
                            </div>
                    <?php
                        }
                    }
                    ?>
                    <?php if (!$memberFound) { ?> 
                        <?php foreach ($pesanMasuk as $pesan) { ?>
                            <?php if ($pesan['user_id'] == session()->get('user_id') && $pesan['status'] == 'terbayar') { ?>
                                <input class="text-center form-control text-success fw-bold" value="Sedang Dalam Prosess..">
                                <p>Waktu Pengajuan : <?php echo $pesan['waktu_pesan'] ?></p>
                                <p>Pilihan Member : <?php echo $pesan['jenis_member'] ?></p>
                                <p>Masa Aktif : <?php echo $pesan['bulan'] ?></p>
                                <p>Status : <span class="text-success fw-bold text-uppercase"><?php echo $pesan['status'] ?></span></p>
                                <p>Waktu Pembayaran : <?php echo $pesan['waktu_bayar'] ?></p>
                                <p><strong class="text-warning">*Terimakasih sudah melakukan pembayaran, Tunggu Member diaktifkan 1-3 hari kerja..!</strong></p>
                            <?php } ?>
                        <?php } ?>
                    <?php }   ?>

                <?php endif; ?>

                <div id="pesanKosong" class="text-center text-danger fw-bold fs-6 d-none">
                    *Silakan Ajukan Membership untuk mendapatkan Diskon Harga SPECIAL*
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="tutupStatusMember()">Tutup</button>
            </div>
        </div>
    </div>
</div>
<!-- End modal menu favorit  -->