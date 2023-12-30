<div class="modal fade" id="modalKeranjang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pesanan <span id="infoMember" class="fw-bold"></span></h5>
            </div>
            <div class="modal-body p-0 text-center">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-warning text-white">Nama</span>
                                </div>
                                <input type="text" id="nama" class="form-control" value="<?= session()->get('user_name'); ?>" disabled>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="user_id" value="<?php echo session()->get('user_id'); ?>" class="form-control" aria-label="Amount (to the nearest dollar)">
                    <div class="col-6">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-warning text-white">No Meja</span>
                                </div>
                                <!-- setinggan nomor meja -->
                                <select name="noMeja" id="noMeja" class="form-control fw-bold">
                                    <option value="">Pilih Meja</option>
                                    <!-- Akan menampilkan Meja yang sedang di isi no meja berwarna merah -->
                                    <?php foreach ($antrian as $antri) : ?>
                                        <?php if ($antri['status'] == 0 || $antri['status'] == 1) { ?>
                                            <option value="" style="color:red;" disabled><?php echo $antri['noMeja']; ?> (Terisi)</option>
                                        <?php  } ?>
                                    <?php endforeach; ?>
                                    
                                    <!-- Ketika pelanggan sudah selesai pesan, maka no meja akan bisa kembali di gunakan  -->
                                    <?php foreach ($antrian as $antri) : ?>
                                        <?php if ($antri['status'] == 2) { ?>
                                            <option value="<?php echo $antri['noMeja']; ?>"><?php echo $antri['noMeja']; ?> (Kosong)</option>
                                            <?php } ?>;
                                        <?php endforeach; ?>

                                        <?php for ($i = 1; $i <= 10; $i++) : ?>
                                            <?php $found = false; ?>
                                            <?php foreach ($antrian as $antri) : ?>
                                                <?php if ($antri['noMeja'] == $i) {
                                                    $found = true;
                                                    break;
                                                } ?>
                                            <?php endforeach; ?>

                                            <?php if (!$found) : ?>
                                                <option value="<?php echo $i; ?>"><?php echo $i; ?> (Kosong)</option>
                                            <?php endif; ?>
                                        <?php endfor; ?>
                                        
                                        <!-- Ketika tidak ada yang beli atau data antrian kosong, maka meja akan ditampilkan semua  -->
                                        <?php foreach ($antrian as $antri) : ?>
                                            <?php if (empty($antrian)) { ?>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                            <?php } ?>
                                        <?php endforeach; ?>
                                </select>
                                <!-- selesai setinggan nomor meja -->
                            </div>
                        </div>
                    </div>
                </div>

                <table class="table text-center bg-white" id="dataTable">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Jml</th>
                            <th>Harga</th>
                            <th>Total</th>
                            <th>Hapus</th>
                        </tr>
                    </thead>
                    <tbody id="tabelPesanan">
                        <td colspan="5">Sedang Memuat..</td>
                    </tbody>
                </table>
                <input type="hidden" id="harga_akhir" class="form-control" name="harga_akhir">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-warning text-white">Tagihan</span>
                                </div>
                                <input type="text" id="total_bayar" name="total_bayar" class="form-control" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="col-3"></div>
                </div>
                <b id="peringatan" class="badge badge-danger">Silahkan isi nama dan no meja.</b><br>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="tutupModalKeranjang()">Tutup</button>
                <button type="button" class="btn btn-warning" onclick="prosesTransaksi()" id="simpanTransaksi">Pesan dan Bayar</button>
            </div>
        </div>
    </div>
</div>