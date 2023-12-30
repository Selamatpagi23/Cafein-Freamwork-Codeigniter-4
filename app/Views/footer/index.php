<style>
    footer ul li a {
        text-decoration: none;
    }
</style>
<footer>
    <div class="container p-5">
        <div class="row">
            <?php if (session()->get('user_role') == 'pelanggan') { ?>
                <div class="col-lg-6">
                    <img src="<?= base_url() ?>/public/images/<?= $meta['logo'] ?>" width="100px" alt="">
                    <p><strong>Alamat : </strong><?= $meta['alamat_toko'] ?></p>
                    <h5>Hubungi Kami</h5>
                    <ul>
                        <li><a href="<?= $meta['facebook'] ?>" target="_blank"><i class="fa fa-facebook"></i> Facebook</a></li>
                        <li><a href="<?= $meta['youtube'] ?>" target="_blank"><i class="fa fa-youtube"></i> Youtube</a></li>
                        <li><a href="mailto:<?= $meta['email'] ?>" target="_blank"><i class="fa fa-envelope"></i> <?= $meta['email'] ?></a></li>
                    </ul>
                </div>

                <div class="col-lg-6">
                    <h5>Membership</h5>
                    <p>Dapatkan harga diskon dengan menjadi Member.
                    <ul>
                        <li>SILVER Diskon 5%</li>
                        <li>PLATINUM Diskon 10%</li>
                        <li>EMAS Diskon 15%</li>
                    </ul>
                    </p>
                    <form action="Dashboard/joinMember" method="POST">
                        <input type="hidden" name="nama_user" value="<?php echo session()->get("user_name") ?>">
                        <input type="hidden" name="email" value="<?php echo session()->get("user_email") ?>">
                        <input type="hidden" name="user_id" value="<?php echo session()->get("user_id") ?>">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-primary text-white">Masa Aktif</span>
                                </div>
                                <select name="bulan" class="form-control">
                                    <option>Pilih Masa Aktif..</option>
                                    <option value="30 Hari">30 Hari</option>
                                    <option value="60 Hari">60 Hari</option>
                                    <option value="90 Hari">90 Hari</option>
                                    <option value="120 Hari">120 Hari</option>
                                    <option value="Request Langsung">Request Langsung</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-primary text-white">Jenis Member</span>
                                </div>
                                <select name="jenis_member" class="form-control">
                                    <option>Jenis Member..</option>
                                    <option value="SILVER">Silver</option>
                                    <option value="PLATINUM">Platinum</option>
                                    <option value="EMAS">Emas</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success">Jadi Member</button>
                    </form>
                </div>

            <?php } else { ?>
                <div class="col-lg-8">
                    <img src="<?= base_url() ?>/public/images/<?= $meta['logo'] ?>" width="100px" alt="">
                    <p><strong>Alamat : </strong><?= $meta['alamat_toko'] ?></p>
                </div>
                <div class="col-lg-4">
                    <h5>Hubungi Kami</h5>
                    <ul>
                        <li><a href="<?= $meta['facebook'] ?>" target="_blank"><i class="fa fa-facebook"></i> Facebook</a></li>
                        <li><a href="<?= $meta['youtube'] ?>" target="_blank"><i class="fa fa-youtube"></i> Youtube</a></li>
                        <li><a href="mailto:<?= $meta['email'] ?>" target="_blank"><i class="fa fa-envelope"></i> <?= $meta['email'] ?></a></li>
                    </ul>
                </div>

            <?php } ?>
        </div>
    </div>
</footer>