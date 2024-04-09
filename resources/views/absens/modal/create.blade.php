<!-- Modal -->
<div class="modal fade" id="absensi_create_modal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Lakukan Absensi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form name="commodity_create" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label for="name">Nama Lengkap</label>
                <input type="text" class="form-control" name="name" id="name_create" value="{{ auth()->user()->name }}" readonly>
              </div>
            </div>

            <div class="col-lg-6">
              <div class="form-group">
                <label for="jabatan">Guru / Kelas</label>
                <input type="text" class="form-control" name="jabatan" id="jabatan_create" value="{{ auth()->user()->deskripsi }}" readonly>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-5">
              <div class="form-group">
                <label for="material">Tanggal Absen</label>
                <input type="text" class="form-control" id="pinjam" placeholder="<?php echo date('d-m-Y'); ?>" disabled>
              </div>
            </div>

            <div class="col-lg-4">
              <div class="form-group">
                <label for="mata_pelajarans_id">Mata Pelajaran</label>
                <select class="select2-select-dropdown" name="mata_pelajarans_id" id="mata_pelajarans_id_create" style="width: 100%;">
                  <option selected>Pilih</option>
                  @foreach($mata_pelajarans as $mata_pelajaran)
                  <option value="{{ $mata_pelajaran->id }}">{{ $mata_pelajaran->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="col-lg-3">
              <div class="form-group">
                <label for="condition">Kehadiran</label>
                <select class="select2-select-dropdown" name="condition" id="condition_create" style="width: 100%;">
                  <option selected>Pilih</option>
                  <option value="1">Hadir</option>
                  <option value="2">Sakit</option>
                  <option value="3">Tidak Hadir</option>
                </select>
              </div>
            </div>
          </div>
          <hr>

          <div class="row">
            <div class="col-lg-12">
              <div class="form-group">
                <label for="note">Keterangan</label>
                <textarea class="form-control" name="note" id="note_create" rows="3" style="height: 100px;"></textarea>
              </div>
            </div>
            <div class="col-lg-5">
              <div class="form-group">
                <label for="status">Bukti Kehadiran</label>
                <input type="file" class="form-control" name="status" id="status_create">
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary">Tambah Data</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
  function hitungTotal() {
    var harga = document.getElementById('price_per_item_create').value;
    var kuantitas = document.getElementById('quantity_create').value;
    var total = harga * kuantitas; // Perkalian harga dengan kuantitas

    document.getElementById('price_create').value = total; // Menampilkan hasil ke dalam form total
  }
</script>