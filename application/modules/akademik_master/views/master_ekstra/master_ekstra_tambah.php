<div class="modal fade modal-action" id="modal-md">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?= ucwords($this->uri->segment(3, 0)) ?> Data</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="" role="form" id="form-action" enctype="multipart/form-data">
                <input type="hidden" name="kd_sekolah" value="<?= $pegawai['kd_sekolah'] ?>">

                <div class="modal-body">                  
                    <div class="form-group">
                        <label for="nama" class="col-sm-3 control-label">Nama</label>
                        <div class="col-sm-9">
                            <input type="text" name="nama" class="form-control" id="nama" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="bi bi-arrow-counterclockwise"></i> Tutup</button>
                    <button type="submit" id="simpan" class="btn btn-primary"><i class="bi bi-save2"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>