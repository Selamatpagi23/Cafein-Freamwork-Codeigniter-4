<!-- modal mennu Favorit  -->
<div class="modal fade" id="modalMenuFavorit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <h5 class="modal-title text-center p-3" id="exampleModalLabel">********* Menu Favorit *********</h5>
            <div class="modal-body">
                <h5 class="text-center"><strong style="color: green;">Menu terbanyak di pesan oleh pelanggan</strong></h5>
                <?php if (session()->get('user_id')) : ?>
                    <?php

                    // Inisialisasi array untuk menyimpan jumlah setiap menu berdasarkan jenis
                    $jumlahMenu = array();

                    // Hitung jumlah setiap menu berdasarkan jenis
                    foreach ($pembelian as $item) {
                        $menu = $item['namaMenu'];
                        $foto = $item['foto'];
                        $jenis = $item['jenis'];
                        $jumlah = $item['jumlah'];

                        $key = $jenis . '_' . $menu; // Gunakan kombinasi jenis dan namaMenu sebagai kunci

                        if (!isset($jumlahMenu[$key])) {
                            $jumlahMenu[$key] = array('jenis' => $jenis, 'namaMenu' => $menu, 'jumlah' => $jumlah, 'foto' => $foto);
                        } else {
                            $jumlahMenu[$key]['jumlah'] += $jumlah;
                        }
                    }

                    // Temukan menu dengan jumlah terbanyak untuk setiap jenis
                    $jenisMenuTerbanyak = array();

                    foreach ($jumlahMenu as $key => $data) {
                        $jenis = $data['jenis'];
                        $jumlah = $data['jumlah'];

                        if (!isset($jenisMenuTerbanyak[$jenis]) || $jumlah > $jenisMenuTerbanyak[$jenis]['jumlah']) {
                            $jenisMenuTerbanyak[$jenis] = $data;
                        }
                    }
                    ?>

                    <!-- Tampilkan hasil -->
                    <?php foreach ($jenisMenuTerbanyak as $jenis => $data) { ?>
                        <?php if ($jenis == 1) { ?>
                            <input type="text" class="form-control text-center fw-bold" value="Makanan" disabled>
                        <?php } else if ($jenis == 2) { ?>
                            <input type="text" class="form-control text-center fw-bold" value="Aneka Cemilan / Snack" disabled>
                        <?php } else if ($jenis == 3) { ?>
                            <input type="text" class="form-control text-center fw-bold" value="Minuman Dingin" disabled>
                        <?php } else if ($jenis == 4) { ?>
                            <input type="text" class="form-control text-center fw-bold" value="Minuman Panas" disabled>
                        <?php } ?>

                        <div class="text-center" style="border: solid yellow 2px;border-radius:5px;">
                            <img src="<?= base_url() ?>/public/images/menu/<?= $data["foto"] ?>" width="100%" height="300px" alt="">
                            <h5 class="pt-3"><?= $data['namaMenu'] ?></h5>
                            <p>Jumlah Pesanan: <span class="text-success fw-bold"><?= $data['jumlah'] ?></span></p>
                        </div>
                        <br>
                    <?php } ?>
                <?php endif; ?>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="tutupMenuFavorit()">Tutup</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End modal menu favorit  -->