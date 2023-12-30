<?php $this->extend('template') ?>

<?php $this->section('content') ?>
<style>
    .col-form-label {
        font-weight: bold;
    }

    .keyword-list {
        margin-top: 10px;
    }

    /* Style for the keyword label-like boxes */
    .keyword-label {
        background-color: grey;
        color: white;
        padding: 5px 10px;
        border-radius: 5px;
        margin: 5px;
        max-width: 300px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        display: inline-block;
        position: relative;
    }

    /* Style for the close button (X) */
    .close-button {
        position: absolute;
        top: -7px;
        right: 0;
        font-size: 15px;
        cursor: pointer;
        color: red;
        font-weight: bolder;
    }

    #keywords {
        width: 100%;
        border: none;
        background: transparent;
        outline: none;
        resize: none;
        -webkit-resize: none;
        /* Untuk browser berbasis WebKit (misalnya Chrome dan Safari) */
        -moz-resize: none;
        /* Untuk browser berbasis Gecko (misalnya Firefox) */
        -o-resize: none;
        /* Untuk browser Opera */
        -ms-resize: none;
        /* Untuk browser Microsoft Edge */
    }
</style>
<div class="card p-5" style="max-height: 390px; overflow-y: auto;">

    <form id="editMeta" method="POST" enctype="multipart/form-data">

        <h3 class="card-title text-success" style="border-bottom: 2px solid green;width:145px">* Bagian Footer *</h3>
        <div class="row mb-3">
            <label for="logo" class="col-md-4 col-lg-3 col-form-label">Logo</label>
            <div class="col-md-8 col-lg-9">
                <img src="" alt="logo" id="logoThumbnail" name="logo" width="100px">
                <div class="pt-2">
                    <input name="logo" id="logoInput" type="file" multiple style="opacity: 0;position: absolute;margin: 0;padding: 0;outline: none;">
                    <i class="btn btn-primary btn-sm mdi mdi-upload logoInput"></i>
                    <span class="text-secondary">Max 2MB </span>
                </div>
                <a id="compressLinkLogo" href="https://www.iloveimg.com/id/kompres-gambar" target="_blank" style="display: none;" class="text-light fw-bolder mt-3 btn btn-success">Compress Now</a>
            </div>
        </div>

        <div class="row mb-3">
            <label for="alamat" class="col-md-4 col-lg-3 col-form-label">Alamat</label>
            <div class="col-md-8 col-lg-9">
                <textarea name="alamat_toko" id="alamat_toko" cols="30" rows="10" class="form-control" style="height: 100px;"></textarea>
            </div>
        </div>

        <div class="row mb-3">
            <label for="facebook" class="col-md-4 col-lg-3 col-form-label">Link Facebook</label>
            <div class="col-md-8 col-lg-9">
                <input name="facebook" type="text" class="form-control" id="facebook">
            </div>
        </div>

        <div class="row mb-3">
            <label for="youtube" class="col-md-4 col-lg-3 col-form-label">Link Youtube</label>
            <div class="col-md-8 col-lg-9">
                <input name="youtube" type="text" class="form-control" id="youtube">
            </div>
        </div>

        <div class="row mb-3">
            <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
            <div class="col-md-8 col-lg-9">
                <input name="email" type="email" class="form-control" id="email">
            </div>
        </div>
        <hr>
        <h3 class="card-title text-success" style="border-bottom: 2px solid green;width:130px">* Bagian Meta *</h3>
        <input type="hidden" name="id_meta" id="id_meta">
        <div class="row mb-3">
            <label for="favicon" class="col-md-4 col-lg-3 col-form-label">Favicon</label>
            <div class="col-md-8 col-lg-9">
                <img src="" alt="favicon" id="faviconThumbnail" name="favicon" width="50px">
                <div class="pt-2">
                    <input name="favicon" id="faviconInput" type="file" multiple style="opacity: 0;position: absolute;margin: 0;padding: 0;outline: none;">
                    <i class="btn btn-primary btn-sm mdi mdi-upload faviconInput"></i>
                    <span class="text-secondary">Max 100KB </span>
                </div>
                <a id="compressLink" href="https://favicon.io/favicon-converter/" target="_blank" style="display: none;" class="text-light fw-bolder mt-3 btn btn-success">Compress Now</a>
            </div>
        </div>

        <div class="row mb-3">
            <label for="title" class="col-md-4 col-lg-3 col-form-label">Title</label>
            <div class="col-md-8 col-lg-9">
                <input name="title" type="text" class="form-control" id="title">
            </div>
        </div>

        <div class="row mb-3">
            <label for="description" class="col-md-4 col-lg-3 col-form-label">Description</label>
            <div class="col-md-8 col-lg-9">
                <textarea name="description" class="form-control" id="description" style="height: 100px;overflow-y: auto;"></textarea>
            </div>
        </div>

        <div class="row mb-3">
            <label for="keywords" class="col-md-4 col-lg-3 col-form-label">Keywords</label>
            <div class="col-md-8 col-lg-9 p-3" style="height: 300px;border:solid 2px #dedede;border-radius:10px;overflow-y: auto;">
                <span class="keyword-list" id="keywordList"></span>
                <textarea name="keywords" class="text-dark" style="border:none;outline:none;" id="keywords" placeholder="Input Here"></textarea>
            </div>
            <div id="CountChar" style="text-align:right;">/500</div>
        </div>

        <div class="text-left">
            <button type="button" class="btn btn-success" onclick="updateMeta()">Simpan Perubahan</button>
        </div>
    </form>

</div>
<!-- erro modal  -->
<div class="modal fade" id="errorModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Warning Message</h5>
            </div>
            <div class="modal-body">
                <div id="errorMessage" class="fw-bold text-capitalize" style="text-align: center;"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- end error modal  -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Menampilkan Data Meta  -->
<script>
    // View Edit Meta 
    let metaData;

    function formMeta(data) {
        $('#id_meta').val(data[0].id_meta);
        $('#logoThumbnail').attr('src', '<?= base_url() ?>/public/images/' + data[0].logo);
        $('#faviconThumbnail').attr('src', '<?= base_url() ?>/public/images/' + data[0].favicon);
        $('#title').val(data[0].title);
        $('#description').val(data[0].description);
        $('#alamat_toko').val(data[0].alamat_toko);
        $('#facebook').val(data[0].facebook);
        $('#youtube').val(data[0].youtube);
        $('#email').val(data[0].email);

        // Pisahkan kata kunci berdasarkan koma
        const keywords = data[0].keywords.split(',').filter(keyword => keyword.trim());
        for (const keyword of keywords) {
            addKeyword(keyword); // Panggil fungsi addKeywordLabel untuk menambahkan label keyword
        }
    }

    function getMetaData() {
        $.ajax({
            url: `<?= base_url() ?>/Meta/dataMeta`,
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                metaData = data;
                formMeta(metaData);
            },
            error: function(error) {
                console.error(error, 'Error retrieving meta data');
            }
        });
    }
    getMetaData();

    const maxCharCountInput = 500; // Maksimum 500 karakter pada input
    const maxCharCount = 500; // Maksimum 500 karakter untuk label

    const keywordsInput = document.getElementById('keywords');
    const keywordsTextarea = document.getElementById('keywords');
    const keywordList = document.getElementById('keywordList');
    const countCharElement = document.getElementById('CountChar');

    let totalCharCount = 0;

    keywordsTextarea.addEventListener('input', function() {
        this.style.height = 'auto'; // Reset tinggi textarea
        this.style.height = (this.scrollHeight === 0 ? '10px' : this.scrollHeight + 'px'); // Sesuaikan tinggi textarea dengan konten atau atur tinggi 1 baris jika tidak ada input
    });


    keywordsInput.addEventListener('input', function(event) {
        const inputValue = keywordsInput.value;
        if (inputValue.length > maxCharCountInput) {
            keywordsInput.value = inputValue.slice(0, maxCharCountInput); // Potong teks jika melebihi 500 karakter
        }

        // Perbarui nilai CountChar saat input berubah
        updateCountChar();
    });

    function getKeywordsFromLabels() {
        const labels = keywordList.getElementsByClassName('keyword-label');
        const keywords = [];
        for (const label of labels) {
            keywords.push(label.textContent);
        }
        return keywords.join(', ');
    }

    keywordsTextarea.addEventListener('keydown', function(event) {
        if (event.key === 'Enter') {
            event.preventDefault(); // Mencegah karakter newline ditambahkan ke textarea
            const keyword = keywordsTextarea.value.trim();
            if (keyword.length + totalCharCount <= maxCharCount) {
                if (keyword.includes('.')) {
                    swal({
                        icon: 'error',
                        title: 'Gunakan koma untuk memisah Keywords',
                        button: 'OK',
                    });

                    return;
                }

                const existingKeywords = getKeywordsFromLabels();
                const newKeywords = keyword.split(',').map(k => k.trim()).filter(k => k !== ''); // Pisahkan kata kunci berdasarkan koma
                const updatedKeywords = [...existingKeywords.split(', '), ...newKeywords].join(', ');

                for (const kw of newKeywords) {
                    addKeyword(kw); // Tambahkan kata kunci ke label jika valid
                }
                keywordsTextarea.value = ''; // Mengosongkan textarea
            } else {
                // Tampilkan pesan jika melebihi 500 karakter
                swal({
                    icon: 'error',
                    title: 'Maksimal 500 Karakter',
                    button: 'OK',
                });
            }
            // Perbarui nilai CountChar setelah menambahkan label atau mengedit
            updateCountChar();
        }
    });


    function addKeyword(keyword) {
        const keywordLabel = document.createElement('span');
        keywordLabel.textContent = keyword;
        keywordLabel.classList.add('keyword-label');

        // Create a close button (X) for removing the keyword
        const closeButton = document.createElement('span');
        closeButton.innerHTML = '&times;';
        closeButton.classList.add('close-button');
        closeButton.addEventListener('click', function() {
            keywordLabel.remove(); // Remove the keyword label when the close button is clicked
            totalCharCount -= keyword.length; // Kurangi total karakter saat menghapus label

            // Perbarui nilai CountChar setelah menghapus label
            updateCountChar();
        });

        keywordLabel.appendChild(closeButton);
        keywordList.appendChild(keywordLabel);

        // Perbarui nilai CountChar
        totalCharCount += keyword.length;
        updateCountChar();
    }

    function updateCountChar() {
        const inputValue = keywordsInput.value;
        const charCount = totalCharCount + inputValue.length;
        countCharElement.textContent = charCount + '/' + maxCharCount;

        // Ubah warna teks menjadi merah jika mencapai 500 karakter
        if (charCount >= maxCharCount) {
            countCharElement.style.color = 'red';
        } else {
            countCharElement.style.color = ''; // Kembalikan warna teks ke default jika tidak mencapai 500 karakter
        }
    }

    // End View Edit Meta
</script>

<!-- Hanlde Logo Image  -->
<script>
    // // Fungsi formatFileSize untuk mengonversi ukuran file ke format yang lebih mudah dibaca
    function formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';

        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));

        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }

    $('#logoInput').change(function() {
        const maxPixelSize = 1920; // Ukuran pixel maksimum yang diizinkan
        const maxSizeInBytes = 2 * 1024 * 1024; // 2 MB
        const Formats = ['jpg', 'jpeg', 'png', 'gif', 'ico'];
        const files = this.files;
        const compressLinkLogo = $('#compressLinkLogo');
        compressLinkLogo.hide();

        let fileList = '';

        for (let i = 0; i < files.length; i++) {
            const file = files[i]; // Mengganti files[1] menjadi files[i]
            const extension = file.name.split('.').pop().toLowerCase();
            fileList += file.name + " (" + formatFileSize(file.size) + ")";
            if (!Formats.includes(extension)) {
                fileList += "- Format Tidak di Izinkan";
            }
            fileList += i === files.length - 1 ? "" : ", ";
        }
        $('#editMeta .logoInput').removeClass('btn-danger btn-primary').addClass('btn-success text-light').text(" " + fileList);

        // Memeriksa format file 
        const InvalidFile = Array.from(files).some(file => !Formats.includes(file.name.split('.').pop().toLowerCase()));
        if (InvalidFile) {
            $('#editMeta .logoInput').removeClass('btn-success btn-primary').addClass('btn-danger text-light').text(" " + fileList);
            swal({
                icon: 'error',
                title: "Format tidak diizinkan..!! Gunakan Format File 'jpg', 'jpeg', 'png', 'gif'",
                button: 'OK',
            });
            return; // Menghentikan eksekusi jika ada file dengan format yang tidak diizinkan
        }

        if (files.length > 0) {
            const file = files[0];

            if (file.size > maxSizeInBytes) {
                $('#editMeta .logoInput').removeClass('btn-success btn-primary').addClass('btn-danger text-light').text(" " + fileList);
                swal({
                    icon: 'error',
                    title: "Ukuran file terlalu besar. Maksimum 2MB diizinkan..!",
                    button: 'OK',
                });
                compressLinkLogo.show();

                this.value = ''; // Mengosongkan input file
                $('#logoThumbnail').attr('src', ''); // Menghapus gambar sementara
                return;
            } else {
                $('#editMeta .logoInput').removeClass('btn-danger btn-primary').addClass('btn-success text-light').text(" " + fileList);
                compressLinkLogo.hide();
            }

            const reader = new FileReader();
            reader.onload = function(event) {
                const image = new Image();
                image.src = event.target.result;

                image.onload = function() {
                    const width = this.width;
                    const height = this.height;

                    if (width > maxPixelSize || height > maxPixelSize) {
                        // Ukuran pixel tidak sesuai, tampilkan pesan peringatan dan tautan "Compress Now"
                        $('#editMeta .logoInput').removeClass('btn-success btn-primary').addClass('btn-danger text-light').text(" " + fileList);
                        $('#errorMessage').removeClass('alert-danger').addClass('text-danger').text(`Ukuran pixel harus ${maxPixelSize}x${maxPixelSize} atau lebih kecil.`);
                        compressLinkLogo.attr('href', 'https://www.iloveimg.com/id/kompres-gambar'); // Gantilah 'URL_KOMPRESI_logo' dengan URL yang benar
                        compressLinkLogo.show();
                        $('#errorModal').modal('show');
                        $('#logoThumbnail').attr('src', '');
                    } else {
                        // Ukuran pixel sesuai, tampilkan gambar sementara
                        $('#editMeta .logoInput').removeClass('btn-danger btn-primary').addClass('btn-success text-light').text(" " + fileList);
                        $('#logoThumbnail').attr('src', event.target.result);
                        compressLinkLogo.hide();
                    }
                };
            };
            reader.readAsDataURL(file);
        } else {
            compressLinkLogo.hide();
            $('#logoThumbnail').attr('src', '');
        }
    });
</script>

<!-- Hanlde Favicon Image  -->
<script>
    // // Fungsi formatFileSize untuk mengonversi ukuran file ke format yang lebih mudah dibaca
    function formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';

        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));

        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }

    $('#faviconInput').change(function() {
        const maxPixelSize = 48; // Ukuran pixel maksimum yang diizinkan
        const maxSizeInBytes = 100 * 1024; // 100 KB
        const Formats = ['jpg', 'jpeg', 'png', 'gif', 'ico'];
        const files = this.files;
        const compressLink = $('#compressLink');
        compressLink.hide();

        let fileList = '';

        for (let i = 0; i < files.length; i++) {
            const file = files[i]; // Mengganti files[1] menjadi files[i]
            const extension = file.name.split('.').pop().toLowerCase();
            fileList += file.name + " (" + formatFileSize(file.size) + ")";
            if (!Formats.includes(extension)) {
                fileList += "- Format Tidak di Izinkan";
            }
            fileList += i === files.length - 1 ? "" : ", ";
        }
        $('#editMeta .faviconInput').removeClass('btn-danger btn-primary').addClass('btn-success text-light').text(" " + fileList);

        // Memeriksa format file 
        const InvalidFile = Array.from(files).some(file => !Formats.includes(file.name.split('.').pop().toLowerCase()));
        if (InvalidFile) {
            $('#editMeta .faviconInput').removeClass('btn-success btn-primary').addClass('btn-danger text-light').text(" " + fileList);
            swal({
                icon: 'error',
                title: "Format tidak diizinkan..!! Gunakan Format File 'jpg', 'jpeg', 'png', 'gif'",
                button: 'OK',
            });
            return; // Menghentikan eksekusi jika ada file dengan format yang tidak diizinkan
        }

        if (files.length > 0) {
            const file = files[0];

            if (file.size > maxSizeInBytes) {
                $('#editMeta .faviconInput').removeClass('btn-success btn-primary').addClass('btn-danger text-light').text(" " + fileList);
                swal({
                    icon: 'error',
                    title: "Ukuran file terlalu besar. Maksimum 100KB diizinkan..!",
                    button: 'OK',
                });
                compressLink.show();

                this.value = ''; // Mengosongkan input file
                $('#faviconThumbnail').attr('src', ''); // Menghapus gambar sementara
                return;
            } else {
                $('#editMeta .faviconInput').removeClass('btn-danger btn-primary').addClass('btn-success text-light').text(" " + fileList);
                compressLink.hide();
            }

            const reader = new FileReader();
            reader.onload = function(event) {
                const image = new Image();
                image.src = event.target.result;

                image.onload = function() {
                    const width = this.width;
                    const height = this.height;

                    if (width > maxPixelSize || height > maxPixelSize) {
                        // Ukuran pixel tidak sesuai, tampilkan pesan peringatan dan tautan "Compress Now"
                        $('#editMeta .faviconInput').removeClass('btn-success btn-primary').addClass('btn-danger text-light').text(" " + fileList);
                        $('#errorMessage').removeClass('alert-danger').addClass('text-danger').text(`Ukuran pixel harus ${maxPixelSize}x${maxPixelSize} atau lebih kecil.`);
                        compressLink.attr('href', 'https://favicon.io/favicon-converter/'); // Gantilah 'URL_KOMPRESI_FAVICON' dengan URL yang benar
                        compressLink.show();
                        $('#errorModal').modal('show');
                        $('#faviconThumbnail').attr('src', '');
                    } else {
                        // Ukuran pixel sesuai, tampilkan gambar sementara
                        $('#editMeta .faviconInput').removeClass('btn-danger btn-primary').addClass('btn-success text-light').text(" " + fileList);
                        $('#faviconThumbnail').attr('src', event.target.result);
                        compressLink.hide();
                    }
                };
            };
            reader.readAsDataURL(file);
        } else {
            compressLink.hide();
            $('#faviconThumbnail').attr('src', '');
        }
    });
</script>

<!-- Hanlde UpdateMeta  -->
<script>
    // Update Data Meta 
    function updateMeta() {
        var alamat = $('#alamat_toko').val();
        var facebook = $('#facebook').val();
        var youtube = $('#youtube').val();
        var email = $('#email').val();
        var title = $('#title').val();
        var description = $('#description').val();

        // Mengambil semua elemen "span" dalam "keywordList"
        var keywordLabels = $('#keywordList .keyword-label');

        // Inisialisasi array kosong untuk menyimpan kata kunci
        var keywordsArray = [];

        // Loop melalui setiap elemen "span" dan tambahkan teksnya ke dalam array
        keywordLabels.each(function() {
            // Pastikan untuk hanya mengambil teks label, bukan ikon close-button (x)
            var labelText = $(this).text().replace('×', '').trim();
            keywordsArray.push(labelText);
        });

        // Menggabungkan kata kunci menjadi satu string dengan koma sebagai pemisah
        var keywords = keywordsArray.join(',');

        // Sekarang variabel "keywords" berisi kata kunci yang dipisahkan dengan koma per nilai label, tanpa ikon close-button (x)

        if (alamat.trim() === '') {
            swal({
                icon: 'error',
                title: "Alamat Tidak Boleh Kosong",
                button: 'OK',
            });
        } else if (facebook.trim() === '') {
            swal({
                icon: 'error',
                title: "Link Facebook Tidak Boleh Kosong",
                button: 'OK',
            });
        } else if (youtube.trim() === '') {
            swal({
                icon: 'error',
                title: "Link Youtube Tidak Boleh Kosong",
                button: 'OK',
            });
        } else if (email.trim() === '') {
            swal({
                icon: 'error',
                title: "Email Tidak Boleh Kosong",
                button: 'OK',
            });
        } else if (title.trim() === '') {
            swal({
                icon: 'error',
                title: "Title Tidak Boleh Kosong",
                button: 'OK',
            });
        } else if (description.trim() === '') {
            swal({
                icon: 'error',
                title: "Description Tidak Boleh Kosong",
                button: 'OK',
            });
        } else if (keywords.trim() === '') {
            swal({
                icon: 'error',
                title: "Keywords Tidak Boleh Kosong",
                button: 'OK',
            });
        } else {
            var formData = new FormData(document.getElementById('editMeta'));
            // Menambahkan nilai keywords ke dalam formData
            formData.append('keywords', keywords);

            $.ajax({
                url: '<?= base_url() ?>/Meta/updateMeta',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    response = JSON.parse(response);
                    var message = response.message;

                    if (response.status === 'success') {
                        swal({
                            title: 'Success',
                            text: message,
                            icon: 'success',
                        }).then(function() {
                            window.location.reload();
                        });
                    } else if (response.status === 'error') {
                        swal('Error', message, 'error');
                    }
                },
                error: function() {
                    swal({
                        icon: 'error',
                        title: "Terjadi kesalahan saat mengirim request'",
                        button: 'OK',
                    });
                }
            });
        }
    }
    // End Update Data Meta
</script>
<?php $this->endSection() ?>