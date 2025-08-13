<!-- Modal Tambah Barang -->
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modalEditLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="{{ route('customer.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditLabel">Ubah Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="nama">Nama Barang</label>
                                <input type="text" class="form-control" name="nama" id="nama" placeholder="Barang 1" required>
                            </div>
                            <div class="form-group">
                                <label for="stokMin">Stok Minimum</label>
                                <input type="number" class="form-control" name="stokMinimum" id="stokMin" min="1" value="1" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="stok">Stok</label>
                                <input type="number" class="form-control" name="stok" id="stok" min="1" value="1"  required>
                            </div>
                            <div class="form-group">
                                <label for="stokMax">Stok Maksimum</label>
                                <input type="number" class="form-control" name="stokMaksimum" id="stokMax" min="1" value="1" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tipe">Tipe</label>
                        <select class="form-control select2" name="tipe" id="tipe" required>
                            <option value="">Pilih Tipe</option>
                            <option value="stok">Stok</option>
                            <option value="non_stok">Non Stok</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
