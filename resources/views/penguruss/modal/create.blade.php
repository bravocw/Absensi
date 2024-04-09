<!-- Modal -->
<div class="modal fade" id="commodity_create_modal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Tambah Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form name="commodity_create">
          @csrf
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label for="item_code">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" class="form-control" id="nama_lengkap_create">
              </div>
            </div>

            <div class="col-lg-6">
              <div class="form-group">
                <label for="item_code">Email</label>
                <input type="text" name="email" class="form-control" id="email_create">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-3">
              <div class="form-group">
                <label for="role_create">Jabatan</label>
                <select class="select2-select-dropdown" name="role_create" id="role_create" style="width: 100%;">
                  <option selected>Pilih</option>
                  <option value="Guru">Guru</option>
                  <option value="Siswa">Siswa Kelas</option>
                </select>
              </div>
            </div>

            <div class="col-lg-4">
              <div class="form-group">
                <label for="detail_create">Detail</label>
                <input type="text" name="detail_create" class="form-control" id="detail_create">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-4">
              <div class="form-group">
                <label for="name">Password</label>
                <input type="text" name="password" class="form-control" id="password_create">
              </div>
            </div>
          </div>
      </div>

      <hr>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Tambah Data</button>
      </div>
      </form>
    </div>
  </div>
</div>
</div>