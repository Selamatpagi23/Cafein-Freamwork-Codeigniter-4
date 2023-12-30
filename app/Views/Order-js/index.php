<script>
    // Menghandle icon Order sebelah keranjang 
    function bukaOrder() {
        $("#modalOrder").modal("show");
        dataOrder();
    }

    function tutupModalOrder() {
        $('#modalOrder').modal('hide');
    }

    function noticeOrder() {
        $.ajax({
            type: 'GET',
            url: '<?= base_url() ?>/Dashboard/dataOrder',
            dataType: 'json',
            success: function(data) {
                var user_id = '<?php echo session()->get("user_id"); ?>';
                var matchingData = [];

                // Pastikan data.antrian dan data.transaksi sudah diisi dengan data yang sesuai
                if (data.antrian && data.transaksi) {
                    // Gabungkan data dari kedua model
                    var combinedData = data.antrian.concat(data.transaksi);

                    // Filter data sesuai dengan user_id
                    for (let i = 0; i < combinedData.length; i++) {
                        if (combinedData[i].idUser == user_id) {
                            matchingData.push(combinedData[i]);
                        }
                    }

                    var count = matchingData.length;

                    if (count > 0) {
                        $("#jmlOrder").html(count >= 100 ? '(99+)' : '(' + count + ')');
                    } else {
                        $("#jmlOrder").html('(0)');
                    }
                }
            }
        });
    }
    setInterval(noticeOrder, 1000);

    function dataOrder() {
        var isiOrder = "";
        $.ajax({
            type: 'GET',
            url: '<?= base_url() ?>/Dashboard/dataOrder',
            dataType: 'json',
            success: function(data) {
                var count = 0;
                var user_id = '<?php echo session()->get("user_id"); ?>';
                var matchingData = [];

                // Pastikan data.antrian dan data.transaksi sudah diisi dengan data yang sesuai
                if (data.antrian && data.transaksi) {
                    // Gabungkan data dari kedua model
                    var combinedData = data.antrian.concat(data.transaksi);

                    // Filter data sesuai dengan user_id
                    for (let i = 0; i < combinedData.length; i++) {
                        if (combinedData[i].idUser == user_id) {
                            matchingData.push(combinedData[i]);
                        }
                    }

                    if (matchingData.length > 0) {
                        for (let i = 0; i < matchingData.length; i++) {
                            isiOrder += "<tr><td>" + (i + 1) + "</td><td>" + matchingData[i].nama + "</td><td>" + matchingData[i].noMeja + "</td><td>" + matchingData[i].tanggal + "</td><td>Rp. " + matchingData[i].total_bayar + "</td><td>";

                            if (matchingData[i].status == 0) {
                                isiOrder += "<label class='badge badge-danger'>Belum Bayar";
                            } else if (matchingData[i].status == 2) {
                                isiOrder += "<label class='badge badge-success'>Selesai";
                            } else {
                                isiOrder += "<label class='badge badge-success'>Sedang Proses";
                            }

                            isiOrder += "</label></td></tr>";
                            count++; // Tambahkan hitung data
                        }
                    } else {
                        isiOrder = "<td colspan='6'>Tidak ada data sesuai</td>";
                    }

                    $("#tabelOrder").html(isiOrder);
                }
            }
        });
    }

    // Menghandel icon Keranjang 

    var pesanan = [];
    var ditemukan = false
    var jmlPesanan = 0
    let jmlOrder = 0

    function tambahPesanan(id, nama, harga) {
        ditemukan = false
        jmlPesanan = 0
        for (let i = 0; i < pesanan.length; i++) {
            if (pesanan[i][0] == id) {
                pesanan[i][2] += 1
                ditemukan = true
            }
            jmlPesanan += pesanan[i][2]
        }
        if (ditemukan == false) {
            pesanan.push([id, nama, 1, harga])
            jmlPesanan += 1
        }

        $("#jmlPesanan").html("(" + jmlPesanan + ")")
    }

    let userId = "<?= session()->get('user_id') ?>";

    function jenisMember() {
        return new Promise((resolve, reject) => {
            $.ajax({
                url: '<?= base_url() ?>/Dashboard/getMembershipData',
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    let member = data.find(item => item.user_id === userId)?.level_member;
                    resolve(member);
                },
                error: function(error) {
                    reject(error);
                }
            });
        });
    }

    function masaAktifMember() {
        return new Promise((resolve, reject) => {
            $.ajax({
                url: '<?= base_url() ?>/Dashboard/getMembershipData', // Ganti dengan rute yang sesuai
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    // Cek apakah user_id sama dengan membership, kemudian setelah ketemu
                    // akan muncul level_member yang digunakan dan aktif sampai kapan
                    // Ambil data sesuai user_id
                    let userMembership = data.find(item => item.user_id === userId);

                    if (userMembership) {
                        // Ambil waktu saat ini
                        let waktuSekarang = new Date();

                        // Konversi string waktu awal dan berakhir ke objek Date
                        let waktuAwal = new Date(userMembership.aktif);
                        let waktuBerakhir = new Date(userMembership.sampai);

                        // Hitung selisih waktu dalam milisekon
                        let selisihWaktu = waktuBerakhir - waktuSekarang;

                        // Hitung sisa detik
                        let sisaDetik = Math.floor(selisihWaktu / 1000);

                        resolve(sisaDetik);
                    } else {
                        reject("Membership data not found for user ID: " + userId);
                    }
                },
                error: function(error) {
                    reject(error);
                }
            });
        });
    }

    function tampilkanPesanan() {
        jenisMember().then(member => {
            let cek = member

            if (!cek) {
                var isiPesanan = "";
                var total_bayar = "";
                let total_harga_semua_produk = [];

                for (let i = 0; i < pesanan.length; i++) {
                    isiPesanan += "<tr><td>" + pesanan[i][1] + "</td><td>" + pesanan[i][2] + "</td><td>" + formatRupiah(pesanan[i][3].toString()) + "</td><td>" + formatRupiah((pesanan[i][2] * pesanan[i][3]).toString()) + "</td><td><button href='#' class='badge badge-danger' onClick='hapusPesanan(" + i + ")'>x</button></td></tr>";

                    let harga_akhir = pesanan[i][2] * pesanan[i][3].toString();
                    // konversi harga_akhir ke dalam array
                    total_harga_semua_produk.push(harga_akhir);

                    // Hitung total_bayar dari array
                    let total_bayar = total_harga_semua_produk.reduce((acc, currentValue) => acc + currentValue, 0);

                    $("#harga_akhir").val(total_harga_semua_produk); // data array
                    $("#total_bayar").val(formatRupiah(total_bayar.toString()));

                }
                if (pesanan.length < 1) {
                    $("#simpanTransaksi").prop("disabled", true)
                    isiPesanan = "<td colspan='5'>Pesanan Masih Kosong :)</td>"
                } else {
                    $("#simpanTransaksi").prop("disabled", false)
                }

                $("#tabelPesanan").html(isiPesanan)
            } else {
                masaAktifMember().then(sisaDetik => {
                    //mengecek apakah masa aktif masih ada
                    let waktu = sisaDetik > 0;
                    let silver = member === 'SILVER';
                    let platinum = member === 'PLATINUM';
                    let emas = member === 'EMAS';

                    if (silver && waktu) {
                        let memberSilver = true;
                        if (memberSilver) {
                            $("#infoMember").text("Member SILVER")
                            var isiPesanan = "";
                            var total_bayar = "";
                            var diskon = 5; // %
                            let total_harga_semua_produk = [];

                            for (let i = 0; i < pesanan.length; i++) {
                                var hargaSatuan = pesanan[i][3];
                                var jumlah = pesanan[i][2];

                                // Hitung harga dengan diskon
                                var total_harga = hargaSatuan * jumlah;
                                var nilai_diskon = (diskon / 100) * hargaSatuan;
                                var harga_akhir = total_harga - nilai_diskon;

                                isiPesanan += "<tr><td>" + pesanan[i][1] + "</td><td>" + jumlah + "</td><td>" + formatRupiah(hargaSatuan.toString()) + "</td><td>" + "<s>" + formatRupiah((jumlah * hargaSatuan).toString()) + "</s>" + "<br>" + "<span style='background: wheat;font-weight:bold'>" + formatRupiah(harga_akhir.toString()) + "</span>" + "</td><td><button href='#' class='badge badge-danger' onClick='hapusPesanan(" + i + ")'>x</button></td></tr>";

                                // konversi harga_akhir ke dalam array
                                total_harga_semua_produk.push(harga_akhir);
                                console.log(total_harga_semua_produk)

                                // Hitung total_bayar dari array
                                let total_bayar = total_harga_semua_produk.reduce((acc, currentValue) => acc + currentValue, 0);

                                $("#harga_akhir").val(total_harga_semua_produk); // data array
                                $("#total_bayar").val(formatRupiah(total_bayar.toString()));

                            }
                            if (pesanan.length < 1) {
                                $("#simpanTransaksi").prop("disabled", true)
                                isiPesanan = "<td colspan='5'>Pesanan Masih Kosong :)</td>"
                            } else {
                                $("#simpanTransaksi").prop("disabled", false)
                            }

                            $("#tabelPesanan").html(isiPesanan)
                            $("#total_bayar").html(total_bayar)
                        }
                    } else if (platinum && waktu) {
                        let memberPlatinum = true;
                        if (memberPlatinum) {
                            $("#infoMember").text("Member PLATINUM")
                            var isiPesanan = "";
                            var total_bayar = "";
                            let total_harga_semua_produk = [];

                            var diskon = 10; // %

                            for (let i = 0; i < pesanan.length; i++) {
                                var hargaSatuan = pesanan[i][3];
                                var jumlah = pesanan[i][2];

                                // Hitung harga dengan diskon
                                var total_harga = hargaSatuan * jumlah;
                                var nilai_diskon = (diskon / 100) * total_harga;
                                var harga_akhir = total_harga - nilai_diskon;

                                isiPesanan += "<tr><td>" + pesanan[i][1] + "</td><td>" + jumlah + "</td><td>" + formatRupiah(hargaSatuan.toString()) + "</td><td>" + "<s>" + formatRupiah(total_harga.toString()) + "</s>" + "<br>" + "<span style='background: wheat;font-weight:bold'>" + formatRupiah(harga_akhir.toString()) + "</span>" + "</td><td><button href='#' class='badge badge-danger' onClick='hapusPesanan(" + i + ")'>x</button></td></tr>";

                                // konversi harga_akhir ke dalam array
                                total_harga_semua_produk.push(harga_akhir);

                                // Hitung total_bayar dari array
                                let total_bayar = total_harga_semua_produk.reduce((acc, currentValue) => acc + currentValue, 0);

                                $("#harga_akhir").val(total_harga_semua_produk); // data array
                                $("#total_bayar").val(formatRupiah(total_bayar.toString()));

                            }
                            if (pesanan.length < 1) {
                                $("#simpanTransaksi").prop("disabled", true)
                                isiPesanan = "<td colspan='5'>Pesanan Masih Kosong :)</td>"
                            } else {
                                $("#simpanTransaksi").prop("disabled", false)
                            }

                            $("#tabelPesanan").html(isiPesanan)
                            $("#total_bayar").html(total_bayar)
                        }
                    } else if (emas && waktu) {
                        let memberEmas = true;
                        if (memberEmas) {
                            $("#infoMember").text("Member EMAS")
                            let total_harga_semua_produk = [];
                            var isiPesanan = "";
                            var total_bayar = "";
                            var diskon = 15; // %

                            for (let i = 0; i < pesanan.length; i++) {
                                var hargaSatuan = pesanan[i][3];
                                var jumlah = pesanan[i][2];

                                // Hitung harga dengan diskon
                                var total_harga = hargaSatuan * jumlah;
                                var nilai_diskon = (diskon / 100) * hargaSatuan;
                                var harga_akhir = total_harga - nilai_diskon;

                                isiPesanan += "<tr><td>" + pesanan[i][1] + "</td><td>" + jumlah + "</td><td>" + formatRupiah(hargaSatuan.toString()) + "</td><td>" + "<span style='background: wheat;font-weight:bold'>" + formatRupiah(harga_akhir.toString()) + "</span>" + "</td><td><button href='#' class='badge badge-danger' onClick='hapusPesanan(" + i + ")'>x</button></td></tr>";

                                // konversi harga_akhir ke dalam array
                                total_harga_semua_produk.push(harga_akhir);

                                // Hitung total_bayar dari array
                                let total_bayar = total_harga_semua_produk.reduce((acc, currentValue) => acc + currentValue, 0);

                                $("#harga_akhir").val(total_harga_semua_produk); // data array
                                $("#total_bayar").val(formatRupiah(total_bayar.toString()));

                            }
                            if (pesanan.length < 1) {
                                $("#simpanTransaksi").prop("disabled", true)
                                isiPesanan = "<td colspan='5'>Pesanan Masih Kosong :)</td>"
                            } else {
                                $("#simpanTransaksi").prop("disabled", false)
                            }

                            $("#tabelPesanan").html(isiPesanan)
                            $("#total_bayar").html(total_bayar)
                        }
                    } else if (userId) {
                        var isiPesanan = "";
                        var total_bayar = "";
                        let total_harga_semua_produk = [];

                        for (let i = 0; i < pesanan.length; i++) {
                            isiPesanan += "<tr><td>" + pesanan[i][1] + "</td><td>" + pesanan[i][2] + "</td><td>" + formatRupiah(pesanan[i][3].toString()) + "</td><td>" + formatRupiah((pesanan[i][2] * pesanan[i][3]).toString()) + "</td><td><button href='#' class='badge badge-danger' onClick='hapusPesanan(" + i + ")'>x</button></td></tr>";

                            let harga_akhir = pesanan[i][2] * pesanan[i][3].toString();
                            // konversi harga_akhir ke dalam array
                            total_harga_semua_produk.push(harga_akhir);

                            // Hitung total_bayar dari array
                            let total_bayar = total_harga_semua_produk.reduce((acc, currentValue) => acc + currentValue, 0);

                            $("#harga_akhir").val(total_harga_semua_produk); // data array
                            $("#total_bayar").val(formatRupiah(total_bayar.toString()));


                        }
                        if (pesanan.length < 1) {
                            $("#simpanTransaksi").prop("disabled", true)
                            isiPesanan = "<td colspan='5'>Pesanan Masih Kosong :)</td>"
                        } else {
                            $("#simpanTransaksi").prop("disabled", false)
                        }

                        $("#tabelPesanan").html(isiPesanan)
                        $("#total_bayar").html(total_bayar)
                    }

                }).catch(error => {
                    console.error('Error fetching membership data:', error);
                });
            }

        }).catch(error => {
            console.error('Error fetching membership data:', error);
        });
    }

    function hapusPesanan(id) {
        pesanan.splice(id, 1)
        tampilkanPesanan()
    }

    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }

    function prosesTransaksi() {
        var harga_akhir_str = $('#harga_akhir').val(); // Mendapatkan nilai string dari input dengan ID 'harga_akhir'
        var harga_akhir_array = harga_akhir_str.split(',') //  Konversi ke array
        console.log(harga_akhir_array)

        var total_bayar = $("#total_bayar").val();
        var nama = $('#nama').val();
        var noMeja = $('#noMeja').val();
        if (nama == "") {
            $("#nama").focus()
            $("#peringatan").show()
        } else if (noMeja == "") {
            $("#noMeja").focus()
            $("#peringatan").show()
        } else if (harga_akhir == "") {
            alert('Harga Akhir Error')
        } else if (total_bayar == "") {
            alert('Total Bayar Error')
        } else {
            $("#simpanTransaksi").html('<i class="mdi mdi-reload fa-pulse"></i> Memproses..')
            $.ajax({
                type: 'POST',
                url: '<?= base_url() ?>/Dashboard/tambahPesanan',
                data: {
                    'pesanan': pesanan,
                    'nama': nama,
                    'noMeja': noMeja,
                    'harga_akhir': harga_akhir_array,
                    'total_bayar': total_bayar,
                },
                dataType: 'json',
                success: function(data) {
                    $("#modalKeranjang").modal("hide")
                    pesanan = [];
                    $('#noMeja').val("");
                    $('#total_bayar').val("");
                    tampilkanPesanan();

                    $("#simpanTransaksi").html('Pesan dan Bayar')
                    $("#namaPemesan").html(nama)
                    $("#lokasiMeja").html(noMeja)
                    $("#modalSelesai").modal("show")

                    // Ketika sudah berhasil pesan maka akan muat ulang otomatis
                    $("#modalSelesai").on("hidden.bs.modal", function() {
                        // Dibawah ini untuk muat halaman
                        location.reload();
                    });
                }
            });
        }
    }

    // handle menu Favorit setelah login 
    function bukaMenuFavorit() {
        $("#modalMenuFavorit").modal("show");
    }

    function tutupMenuFavorit() {
        $('#modalMenuFavorit').modal('hide');
    }

    // handle status member 
    function bukaInfoMember() {
        $("#modalStatusMember").modal("show");
        $.ajax({
            url: '<?= base_url() ?>/PesanMasuk/dataPesanMasuk',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                let member = data.find(item => item.user_id === userId);
                console.log(member)
                if (member == false) {
                    $("#pesanKosong").addClass("d-none");
                } else if (data.length === 0) {
                    $("#pesanKosong").removeClass("d-none");
                }
            },
            error: function(error) {
                reject(error);
            }
        });
    }

    function tutupStatusMember() {
        $('#modalStatusMember').modal('hide');
    }
</script>