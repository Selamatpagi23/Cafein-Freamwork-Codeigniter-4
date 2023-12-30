<?php $this->extend('template') ?>

<?php $this->section('content') ?>
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title text-center">Tambah Admin Pengelola</h4>
            </div>
            <div class="card-body">
                <form>
                    <div class="form-group row">
                        <label for="inputName" class="col-lg-3 ">Nama</label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="Masukan Nama" class="form-control" id="name" name="user_name">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputEmail" class="col-lg-3 ">Email</label>
                        <div class="col-sm-9">
                            <input type="email" placeholder="Masukan Email" class="form-control" id="email" name="user_email">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputPassword3" class="col-lg-3 ">Password</label>
                        <div class="col-lg-9">
                            <input type="password" placeholder="Buat Password yang rumit" name="user_password" id="password" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-lg-3 ">Ulangi Password</label>
                        <div class="col-lg-9">
                            <input type="password" placeholder="Ulang Password" name="user_password" id="ulangiPassword" class="form-control">
                        </div>
                    </div>
                    <input type="hidden" value="admin" id="user_role" name="user_role">
                </form>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <button type="button" class="btn btn-info col-sm-12" onclick="tambah()" id="tambah">Tambah</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title text-center">Daftar User</h4>
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
                            Sebagai
                        </th>
                        <th>
                            Hapus
                        </th>
                    </thead>
                    <tbody id="tabelUser">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

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

<script>
    muatData()

    function muatData() {
        $("#tambah").html('<i class="fa fa-spinner fa-pulse"></i> Memproses...')
        $.ajax({
            url: '<?= base_url() ?>/user/muatData',
            method: 'post',
            dataType: 'json',
            success: function(data) {
                var tabel = ''
                for (let i = 0; i < data.length; i++) {
                    tabel += "<tr><td>" + data[i].user_id + "</td><td style='text-transform: capitalize;'>" + data[i].user_name + "</td><td style='text-transform: uppercase;'>" + data[i].user_role + "</td><td>"
                    tabel += "<a href='#' id='hapus" + data[i].user_id + "' onclick='tryHapus(" + data[i].user_id + ", \"" + data[i].user_name + "\")' ><i class='mdi mdi-delete'></i></a></td></tr>"

                }
                if (!tabel) {
                    tabel = '<td class="text-center" colspan="2">Data Masih kosong :)</td>'
                }
                $("#tabelUser").html(tabel)

                $("#tambah").html('Tambah')
            }
        });
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

    function tambah() {
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
                data: 'user_name=' + $("#name").val() + '&user_email=' + $("#email").val() + '&user_password=' + $("#ulangiPassword").val() + '&user_role=' + $("#user_role").val(),
                url: '<?= base_url() ?>/user/tambah',
                dataType: 'json',
                success: function(data) {
                    $("#name").val("");
                    $("#email").val("");
                    $("#password").val("");
                    $("#ulangiPassword").val("");
                    $("#user_role").val("");
                    swal("Success", "Selamat, Berhasil menambahkan Admin...!", "success");
                    muatData();
                }
            });
        }
    }

    function tryHapus(user_id, user_name) {
        $("#idHapus").val(user_id)
        $("#detailHapus").html(user_name)
        $("#modalHapus").modal('show')
    }

    function tutupModal() {
        $("#modalHapus").modal('hide')
    }

    function hapus() {
        $("#hapus").html('<i class="fa fa-spinner fa-pulse"></i> Memproses..')
        var id = $("#idHapus").val()
        $.ajax({
            url: '<?= base_url() ?>/user/hapus',
            method: 'post',
            data: "user_id=" + id,
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