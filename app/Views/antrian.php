<?php $this->extend('template') ?>

<?php $this->section('content') ?>
<div class="row">
    <div class="col-lg-5 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Data Pelanggan</h4>
                <p class="card-description">
                    Meja yang memiliki pesanan belum dihidangkan.
                </p>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Meja</th>
                                <th>Nama</th>
                                <th>Status</th>
                                <th>Ubah</th>
                            </tr>
                        </thead>
                        <tbody id="tabelAntrian">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-7 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Data Pelanggan Selesai</h4>
                <p class="card-description">
                    Pesanan pelanggan yang sudah dihidangkan hari ini.
                </p>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Meja</th>
                                <th>Nama</th>
                                <th>Status</th>
                                <th>Rincian</th>
                                <th>Invoice</th>
                            </tr>
                        </thead>
                        <tbody id="tabelAntrianSelesai">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalRincian" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Data Pesanan</h5>
            </div>
            <div class="modal-body p-0">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-warning text-white">Nama</span>
                                </div>
                                <input type="text" id="nama" class="form-control" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-warning text-white">No Meja</span>
                                </div>
                                <input type="number" id="noMeja" class="form-control" disabled>
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
                        </tr>
                    </thead>
                    <tbody id="tabelRincian">
                        <td colspan="5">Memuat data....</td>
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-3"></div>
                    <div class="col-6">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-warning text-white">Rp.</span>
                                </div>
                                <input type="number" id="totalHarga" class="form-control" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="col-3"></div>
                </div>
            </div>
            <span id="Invoice"></span>
            <div class="modal-footer">
                <input type="hidden" id="idTransaksi">
                <input type="hidden" id="statusTransaksi">
                <button type="button" class="btn btn-secondary" onclick="tutupModalRincian()">Tutup</button>
                <button type="button" class="btn btn-warning" onclick="proses()" id="proses">Bayar</button>
            </div>
        </div>
    </div>
</div>

<!-- Sertakan pdfmake -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/vfs_fonts.js"></script>
<script>
    function cetakInvoice(id, nama, noMeja, tanggal, total_bayar) {
        $.ajax({
            type: 'POST',
            url: '<?= base_url() ?>/Antrian/rincianPesanan',
            data: {
                idAntrian: id
            }, // Kirim ID Antrian sebagai data POST
            dataType: 'json',
            success: function(data) {
                // Periksa apakah data telah diterima dengan benar
                if (Array.isArray(data) && data.length > 0) {
                    // Definisikan struktur dokumen PDF
                    let logo = '<?php echo $meta['logo'] ?>';
                    let company = '<?php echo $meta['title'] ?>';
                    let address = '<?php echo $meta['alamat_toko'] ?>';
                    let imageUrl = `<?= base_url() ?>/public/images/${logo}`;

                    // Menggunakan Fetch API untuk mengambil data gambar sebagai blob
                    fetch(imageUrl)
                        .then(response => response.blob())
                        .then(blob => {
                            var reader = new FileReader();
                            reader.onload = function() {
                                // Setelah data URL gambar didapatkan, gunakan dalam dokumenDefinition
                                var documentDefinition = {
                                    content: [{
                                            columns: [
                                                // Kolom pertama untuk logo
                                                {
                                                    image: reader.result,
                                                    width: 100,
                                                    alignment: 'left',
                                                    margin: [0, 0, 10, 0]
                                                },
                                                {
                                                    stack: [{
                                                            text: 'INVOICE',
                                                            style: 'header',
                                                            alignment: 'right'
                                                        },
                                                        {
                                                            text: `Tanggap Beli : ${tanggal}`,
                                                            style: 'subheader',
                                                            alignment: 'right'
                                                        },
                                                        {
                                                            text: `Pembeli : ${nama}`,
                                                            style: 'subheader',
                                                            alignment: 'right'
                                                        },
                                                        {
                                                            text: `No Meja : ${noMeja}`,
                                                            style: 'subheader',
                                                            alignment: 'right'
                                                        }
                                                    ]
                                                },
                                            ]
                                        },
                                        {
                                            text: '\n'
                                        },
                                        {
                                            columns: [{
                                                    stack: [{
                                                            text: 'Pembayaran',
                                                            style: 'subheader',
                                                            alignment: 'left'
                                                        },
                                                        {
                                                            text: company,
                                                            style: 'strong',
                                                            alignment: 'left'
                                                        },
                                                    ]
                                                },
                                                {
                                                    stack: [{
                                                            text: 'Alamat',
                                                            style: 'subheader',
                                                            alignment: 'left'
                                                        },
                                                        {
                                                            text: address,
                                                            style: 'strong',
                                                            alignment: 'left'
                                                        },
                                                    ]
                                                },
                                                {
                                                    stack: [{
                                                        text: ' ',
                                                        style: 'subheader',
                                                        alignment: 'left'
                                                    }, ]
                                                }
                                            ]
                                        },

                                        {
                                            text: '\n \n'
                                        },
                                        {
                                            table: {
                                                widths: ['*', '*', '*'],
                                                body: [
                                                    [{
                                                            text: 'Nama Produk',
                                                            style: 'productColumn'
                                                        },
                                                        {
                                                            text: 'Jumlah',
                                                            style: 'productColumn'
                                                        },
                                                        {
                                                            text: 'Harga',
                                                            style: 'productColumn'
                                                        }
                                                    ]
                                                ]
                                            },
                                            layout: 'noBorders' // Menghilangkan border untuk tampilan lebih clean
                                        },

                                        {
                                            table: {
                                                widths: ['*', '*', '*', ],
                                                body: formatDataForPDF(data, nama, noMeja, tanggal, total_bayar),
                                            },
                                            layout: 'noBorders'
                                        },

                                        {
                                            text: '\n'
                                        },

                                        {
                                            table: {
                                                widths: ['*'],
                                                body: subTotal(data),
                                            },
                                            layout: 'noBorders'
                                        },
                                        {
                                            table: {
                                                widths: ['*'],
                                                body: Diskon(data, total_bayar),
                                            },
                                            layout: 'noBorders'
                                        },
                                        {
                                            text: 'TOTAL        Rp. ' + total_bayar,
                                            style: 'strong',
                                            alignment: 'right'
                                        },

                                        {
                                            text: '\n \n'
                                        },

                                        // Signature 
                                        {
                                            columns: [{
                                                    stack: [{
                                                        text: 'TERIMAKASIH ATAS \n PEMBELIAN ANDA',
                                                        style: 'strong',
                                                        alignment: 'left'
                                                    }, ]
                                                },
                                                {
                                                    stack: [{
                                                            text: `Hormat Kami, .........................................`,
                                                            style: 'signature',
                                                            alignment: 'right'
                                                        },
                                                        {
                                                            text: `  `,
                                                            style: 'signature',
                                                            alignment: 'right'
                                                        },
                                                        {
                                                            text: `  `,
                                                            style: 'signature',
                                                            alignment: 'right'
                                                        },
                                                        {
                                                            text: `(...............................................................)`,
                                                            style: 'signature',
                                                            alignment: 'right'
                                                        }
                                                    ]
                                                },
                                            ]
                                        },
                                        
                                    ],
                                    styles: {
                                        header: {
                                            fontSize: 35,
                                            bold: true,
                                            alignment: 'right', // Pusatkan secara horizontal dan vertikal
                                        },
                                        subheader: {
                                            fontSize: 14,
                                            bold: true,
                                            color: 'grey',
                                            margin: [0, 10, 0, 0],
                                        },
                                        strong: {
                                            fontSize: 13,
                                            bold: true,
                                            margin: [0, 15, 0, 0]
                                        },
                                        signature: {
                                            fontSize: 12,
                                        },
                                        productColumn: {
                                            fontSize: 14,
                                            bold: true,
                                            color: 'white',
                                            fillColor: '#383838',
                                            margin: [0, 3],
                                            alignment: 'center',
                                        },
                                        listProduct: {
                                            fontSize: 13,
                                            bold: true,
                                            color: '#000',
                                            fillColor: '#e4e8ff',
                                            margin: [0, 2],
                                            alignment: 'center',
                                        },
                                        body: {
                                            fontSize: 12,
                                            margin: [0, 0, 0, 10] // Atur margin di bagian bawah
                                        },
                                        subtotal: {
                                            fontSize: 12,
                                            margin: [0, 14, 0, 0]
                                        },
                                        diskon: {
                                            fontSize: 13,
                                            margin: [0, 13, 0, 0]
                                        },
                                    }
                                };

                                // Buat PDF menggunakan pdfmake
                                pdfMake.createPdf(documentDefinition).download('invoice ' + nama + ' Meja ' + noMeja + '.pdf');
                            };
                            reader.readAsDataURL(blob);
                        })
                        .catch(error => console.error('Error fetching image:', error));

                } else {
                    console.error('Data tidak valid atau tidak ada.');
                }

                function formatDataForPDF(data, nama, noMeja, tanggal, total_bayar) {
                    // Pastikan data ada dan merupakan array sebelum menggunakan map
                    if (Array.isArray(data)) {
                        return data.map(item => [{
                                text: item.nama,
                                style: 'listProduct'
                            },
                            {
                                text: item.jumlah,
                                style: 'listProduct'
                            },
                            {
                                text: 'Rp. ' + formatRupiah(item.harga),
                                style: 'listProduct'
                            },
                        ]);

                    } else {
                        return '';
                    }
                }

                function subTotal(data) {
                    const total = data.reduce((accumulator, item) => {
                        const result = item.harga * item.jumlah;
                        return accumulator + result;
                    }, 0);

                    const resultArray = [
                        [{
                            text: 'Sub Total           Rp. ' + formatRupiah(total.toString()),
                            style: 'subtotal',
                            alignment: 'right'
                        }],
                    ];

                    return resultArray;
                }

                function Diskon(data, total_bayar) {
                    const total_bayarNumber = parseInt(total_bayar.replace(/[,.]/g, ''), 10);

                    const total = data.reduce((accumulator, item) => {
                        const result = item.harga * item.jumlah;
                        return accumulator + result;
                    }, 0);

                    const diskon = total - total_bayarNumber;

                    const resultArray = [
                        [{
                            text: 'Diskon           Rp. ' + formatRupiah(diskon.toString()),
                            style: 'diskon',
                            alignment: 'right'
                        }],
                    ];

                    return resultArray;
                }

            }
        });
    }
</script>

<script>
    tampilkanAntrian()
    tampilkanAntrianSelesai()

    function tampilkanAntrian() {
        var isiPesanan = ""
        $.ajax({
            type: 'POST',
            url: '<?= base_url() ?>/antrian/dataAntrian',
            dataType: 'json',
            success: function(data) {
                if (data.length) {
                    for (let i = 0; i < data.length; i++) {
                        isiPesanan += "<tr><td>" + data[i].noMeja + "</td><td>" + data[i].nama + "</td><td>"

                        if (data[i].status == 0) {
                            isiPesanan += "<label class='badge badge-danger'>Bayar"
                        } else {
                            isiPesanan += "<label class='badge badge-success'>Memasak"
                        }

                        isiPesanan += "</label></td><td><button href='#' class='btn btn-inverse-warning btn-sm' onClick='modalRincian(" + data[i].id + ", \"" + data[i].nama + "\", " + data[i].noMeja + "," + data[i].status + ")'><i class='mdi mdi-format-list-bulleted-type'></i><i class='mdi mdi-food-fork-drink'></i></button></td></tr>"
                    }
                } else {
                    isiPesanan = "<td colspan='4'>Antrian Masih Kosong</td>"
                }
                $("#tabelAntrian").html(isiPesanan)
            }
        });
    }

    function tampilkanAntrianSelesai() {
        var isiPesanan = ""
        $.ajax({
            type: 'POST',
            url: '<?= base_url() ?>/antrian/dataAntrianSelesai',
            dataType: 'json',
            success: function(data) {
                if (data.length) {
                    for (let i = 0; i < data.length; i++) {
                        isiPesanan += "<tr><td>" + data[i].noMeja + "</td><td>" + data[i].nama + "</td><td><label class='badge badge-success'>Selesai :)</label></td><td><button href='#' class='btn btn-inverse-success btn-sm' onClick='modalRincian(" + data[i].id + ", \"" + data[i].nama + "\", " + data[i].noMeja + "," + data[i].status + ")'><i class='mdi mdi-playlist-check'></i><i class='mdi mdi-food'></i></button></td><td><button class='btn btn-sm btn-danger' onclick='cetakInvoice(" + data[i].id + ", \"" + data[i].nama + "\", \"" + data[i].noMeja + "\", \"" + data[i].tanggal + "\", \"" + data[i].total_bayar + "\")'>Cetak</button></td></tr>";
                    }
                } else {
                    isiPesanan = "<td colspan='4' class='text-center'>Antrian Masih Kosong</td>"
                }
                $("#tabelAntrianSelesai").html(isiPesanan)

            }
        });
    }

    function modalRincian(id, nama, noMeja, status) {
        $("#nama").val(nama)
        $("#noMeja").val(noMeja)
        $("#proses").show()

        tampilkanRincian(id)
        if (status == 0) {
            $("#proses").html("Bayar")
        } else if (status == 1) {
            $("#proses").html("Selesai")
        } else {
            $("#proses").hide()
        }

        $("#idTransaksi").val(id)
        $("#statusTransaksi").val(status)

        $("#modalRincian").modal("show")
    }

    function proses() {
        var id = $("#idTransaksi").val()
        var status = $("#statusTransaksi").val()

        $.ajax({
            url: '<?= base_url() ?>/antrian/proses',
            method: 'post',
            data: "idTransaksi=" + id + "&statusTransaksi=" + status,
            dataType: 'json',
            success: function(data) {
                tampilkanAntrian()
                tampilkanAntrianSelesai()
                tutupModalRincian()
            }
        });

    }

    function tampilkanRincian(id) {
        var isiPesanan = ""
        $.ajax({
            url: '<?= base_url() ?>/Antrian/rincianPesanan',
            method: 'post',
            data: "idAntrian=" + id,
            dataType: 'json',
            success: function(data) {
                if (data.length) {
                    for (let i = 0; i < data.length; i++) {
                        isiPesanan += "<tr><td>" + data[i].nama + "</td><td>" + data[i].jumlah + "</td><td>" + formatRupiah(data[i].harga.toString()) + "</td><td>" + "<span style='background: wheat;font-weight:bold'>" + formatRupiah((data[i].harga_akhir).toString()) + "</span></td></tr>";

                        $("#totalHarga").val(formatRupiah(data[i].total_bayar.toString()))
                    }
                } else {
                    isiPesanan = "<td colspan='4'>Antrian Masih Kosong :)</td>"
                }
                $("#tabelRincian").html(isiPesanan)

            }
        });
    }

    function tutupModalRincian() {
        $("#modalRincian").modal("hide")
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
</script>
<?php $this->endSection() ?>