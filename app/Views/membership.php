<?php $this->extend('template') ?>

<?php $this->section('content') ?>
<div class="row d-flex justify-content-center">
    <button onclick="tambahMember()" class="btn btn-info col-lg-11 col-md-11 mb-3" style="cursor:pointer
    ;">Tambah</button>
    <div class="col-md-12 col-lg-12 ">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title text-center fw-bold">Daftar Membership</h4>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead class=" text-info">
                        <th>
                            ID
                        </th>
                        <th>
                            Nama
                        </th>
                        <th>
                            Level
                        </th>
                        <th>
                            Pendaftaran
                        </th>
                        <th>
                            Hari Berakhir
                        </th>
                        <th>
                            Hapus
                        </th>
                    </thead>
                    <tbody id="tabelMembership">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tmabah Member  -->
<div class="modal fade" id="modalMember" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Memebership</h5>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group row">
                        <label for="user" class="col-lg-3">Customer</label>
                        <div class="col-lg-9">
                            <select name="user_id" id="user_id" class="form-control">
                                <option value="">Pilihan</option>
                                <?php for ($i = 0; $i < count($user); $i++) {
                                    if ($user[$i]["user_role"] == 'pelanggan') {
                                        echo "<option value='" . $user[$i]["user_id"] . "'>" . $user[$i]["user_name"] . "</option>";
                                    }
                                } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="level_member" class="col-lg-3">Level</label>
                        <div class="col-lg-9">
                            <select name="level_member" id="level_member" class="form-control">
                                <option value="">Pilihan</option>
                                <option value="SILVER">SILVER</option>
                                <option value="PLATINUM">PLATINUM</option>
                                <option value="EMAS">EMAS</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-lg-3">Aktif Sampai?</label>
                        <div class="col-lg-9">
                            <input type="datetime-local" class="form-control" id="sampai" name="sampai">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="form-group row">
                    <div class="col-sm-12 text-center">
                        <button type="button" class="btn btn-info" onclick="tambah()" id="tambah">Tambah</button>
                        <button type="button" class="btn btn-secondary" onclick="tutupMember()">Batal</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- End Modal Member  -->

<!-- Modal Hapus Member  -->
<div class="modal fade" id="modalHapus" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hapus User</h5>
            </div>
            <div class="modal-body">
                <input type="hidden" value="" id="idHapus" name="idHapus">
                <p>Apakah anda yakin ingin menghapus <b id="detailHapus">....</b> ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="hapus()" class="btn btn-info">Hapus</button>
                <button type="button" class="btn btn-secondary" onclick="tutupModal()">Batal</button>
            </div>
        </div>
    </div>
</div>
<!-- End Modal Hapus Member  -->

<script>
    muatData()

    function muatData() {
        $("#tambah").html('<i class="fa fa-spinner fa-pulse"></i> Memproses...')
        $.ajax({
            url: '<?= base_url() ?>/Membership/dataMember',
            method: 'post', // Gunakan metode GET
            dataType: 'json',
            success: function(data) {
                var tabel = '';

                var sekarang = new Date().getTime();

                for (let i = 0; i < data.members.length; i++) {
                    // lakukan perulangan untuk mengetahui jumlah data 
                    if (data.members[i].user_id) {
                        // kemudian jika ada data user_id di members maka akan true lalu di lanjut ke for atau perulangan
                        for (let k = 0; k < data.users.length; k++) {
                            // nah setelah mendapatkan data dari kondisi if members misal 2, lanjut lagi untuk mengetahui jumlah data pada users misal 2 juga;
                            if (data.users[k].user_id == data.members[i].user_id && data.users[k].user_role == 'pelanggan') {
                                // nah langkah terakhir setelah kita mendapatkan jumlah data berdasarkan user_id dari tabel users dan member maka lakukan logika. 

                                // Untuk menampilkan data jika user_id yang ada di tabel member dan users sama maka data akan di tampilkan.

                                // misal di dalam tabel users ada 2 data yakni budi user_id(20) dan anto user_id(30), lalu di dalam tabel member ada 1 yakni PLATINUM user_id(30).

                                // maka yang akan di tampilkan yaitu data anto dengen level member PLATINUM
                                var aktifDate = new Date(data.members[i].aktif).getTime();
                                var sampaiDate = new Date(data.members[i].sampai).getTime();

                                // Menghitung sisa waktu dalam milidetik
                                var selisihWaktu = sampaiDate - sekarang;

                                // Menghitung hari dan jam yang tersisa
                                var hari = Math.floor(selisihWaktu / (1000 * 60 * 60 * 24));
                                selisihWaktu %= 1000 * 60 * 60 * 24;
                                var jam = Math.floor(selisihWaktu / (1000 * 60 * 60));

                                // Menampilkan sisa waktu dalam format yang diinginkan
                                var sisaWaktu = hari + " hari " + jam + " jam";

                                tabel += "<tr><td>" + data.members[i].id_member + "</td><td>" + data.users[k].user_name + "</td><td>" + data.members[i].level_member + "</td><td>" + data.members[i].aktif + "</td><td>" + sisaWaktu + "</td>";

                                tabel += "</td><td><a href='#' id='hapus" + data.members[i].id_member + "' onclick='tryHapus(" + data.members[i].id_member + ", \"" + data.users[k].user_name + " , " + data.members[i].level_member + " , " + " sisa " + sisaWaktu + "\")' ><i class='mdi mdi-delete'></i></a></td></tr>";
                            } 

                        }

                    } 
                }

                if (!tabel) {
                    tabel = '<td class="text-center" colspan="6">Belum Ada Member :)</td>';
                }

                $("#tabelMembership").html(tabel);
                $("#tambah").html('Tambah');
            },
            error: function() {
                $("#tabelMembership").html('<tr><td colspan="2">Gagal mengambil data.</td></tr>');
                $("#tambah").html('Tambah');
            }
        });

    }

    function tambahMember() {
        $('#modalMember').modal('show');
    }

    function tutupMember() {
        $('#modalMember').modal('hide');
    }

    function tambah() {
        if ($("#user_id").val() == "") {
            swal("Error", "Mohon pilih custumer  terlebih dahulu.", "error");
            $("#user_id").focus();
        } else if ($("#level_member").val() == "") {
            swal("Error", "Mohon isi Level Member terlebih dahulu.", "error");
            $("#level_member").focus();
        } else if ($("#sampai").val() == "") {
            swal("Error", "Mohon isi Aktif Sampai? terlebih dahulu.", "error");
            $("#sampai").focus();
        } else {
            $.ajax({
                type: 'POST',
                data: {
                    user_id: $("#user_id").val(),
                    level_member: $("#level_member").val(),
                    sampai: $("#sampai").val()
                },
                url: '<?= base_url() ?>/Membership/tambahMember',
                dataType: 'json',
                success: function(data) {
                    if (data.error) {
                        // Ada kesalahan, tampilkan pesan kesalahan
                        swal("Error", data.error, "error");
                    } else {
                        // Tidak ada kesalahan, bersihkan input dan tutup modal
                        $("#user_id").val("");
                        $("#level_member").val("");
                        $("#sampai").val("");
                        $('#modalMember').modal('hide');
                        swal("Success", "Berhasil Menambah Member :)");
                        muatData();
                    }
                },
                error: function(xhr, status, error) {
                    swal("Error", "Terjadi kesalahan saat menambah member: " + error, "error");
                }
            });
        }
    }

    function tryHapus(id_member, user_name) {
        $("#idHapus").val(id_member);
        $("#detailHapus").html(user_name);
        $("#modalHapus").modal('show');
    }

    function tutupModal() {
        $("#modalHapus").modal('hide')
    }

    function hapus() {
        $("#hapus").html('<i class="fa fa-spinner fa-pulse"></i> Memproses..')
        var id = $("#idHapus").val()
        $.ajax({
            url: '<?= base_url() ?>/Membership/hapusData',
            method: 'post',
            data: "id_member=" + id,
            dataType: 'json',
            success: function(data) {
                $("#idHapus").val("")
                $("#detailHapus").html("")
                $("#modalHapus").modal('hide')
                $("#hapus").html('Hapus')
                muatData()
                tutupModal()
            }
        });
    }
</script>
<?php $this->endSection() ?>