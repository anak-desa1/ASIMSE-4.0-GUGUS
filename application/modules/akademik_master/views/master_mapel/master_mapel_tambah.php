<div class="modal fade modal-action" id="modal-lg">
    <div class="modal-dialog modal-lg">
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
                        <label for="kode" class="col-sm-3 control-label">Kelompok</label>
                        <div class="col-sm-6">
                            <?php echo form_dropdown('kelompok', $p_kelompok, '', 'class="form-control" id="kelompok" required'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="kode" class="col-sm-3 control-label">Tambahan Sub</label>
                        <div class="col-sm-6">
                            <?php echo form_dropdown('tambahan_sub', $p_tambahansub, '', 'class="form-control" id="tambahan_sub" required'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nama" class="col-sm-3 control-label">Kode Singkat</label>
                        <div class="col-sm-6">
                            <input type="text" name="kd_singkat" class="form-control" id="kd_singkat" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nama" class="col-sm-3 control-label">Nama</label>
                        <div class="col-sm-6">
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