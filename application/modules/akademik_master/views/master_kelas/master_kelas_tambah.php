<div class="modal fade modal-action" id="modal-sm">
    <div class="modal-dialog modal-sm">
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
                        <label>Tingkat <span class="symbol required"> </span></label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" autocomplete="off" name="tingkat" required class="form-control" placeholder="Tingkat">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Nama <span class="symbol required"> </span></label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" autocomplete="off" name="nama" required class="form-control" placeholder="Nama Level">
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" id="simpan" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>