<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- Notice swl atau sweet SweetAlert -->
<?php if (session()->getFlashdata('success')) : ?>
    <script>
        swal("Success", "<?= session()->getFlashdata('success'); ?>", "success");
    </script>
<?php endif; ?>

<?php if (session()->getFlashdata('error')) : ?>
    <script>
        swal("Error", "<?= session()->getFlashdata('error'); ?>", "error");
    </script>
<?php endif; ?>