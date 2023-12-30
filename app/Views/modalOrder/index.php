<div class="modal fade" id="modalOrder" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pesanan Dibuat</h5>
            </div>
            <div class="modal-body p-0" style="max-height: 400px; overflow-y: auto;">
                <table class="table text-center bg-white" id="dataTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>No Meja</th>
                            <th>Waktu <br> Order</th>
                            <th>Total <br> Bayar</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody id="tabelOrder">
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="tutupModalOrder()">Tutup</button>
            </div>
        </div>
    </div>
</div>
</div>