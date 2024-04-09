<!-- Modal -->
<div class="modal fade" id="edit_commodity" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">CrossCheck</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form name="commodity_edit">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name_edit">Nama Lengkap</label>
                                <input type="text" name="name_edit" class="form-control" id="name_edit" readonly>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="jabatan_edit">Guru / Kelas</label>
                                <input type="text" name="jabatan_edit" class="form-control" id="jabatan_edit" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label for="created_at_edit">Tanggal Absensi</label>
                                <input type="text" class="form-control" id="created_at_edit" readonly>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="mata_pelajarans_id_edit">Guru / Kelas</label>
                                <input type="text" name="mata_pelajarans_id_edit" class="form-control" id="mata_pelajarans_id_edit" readonly>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="condition_edit">Kehadiran</label>
                                <select class="select2-select-dropdown" id="condition_edit" style="width: 100%;" disabled>
                                    <option selected>Pilih</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="note_edit">Keterangan</label>
                                <textarea class="form-control" id="note_edit" rows="3" readonly></textarea>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label for="status_edit">Bukti Kehadiran</label>
                                <div id="status_edit" class="form-control">Link akan muncul di sini</div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button data-id="" type="submit" class="btn btn-primary" id="swal-update-button"><b>Tolak Data Kehadiran</b></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>