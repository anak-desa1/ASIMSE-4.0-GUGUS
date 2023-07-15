<div class="modal fade modal-admin" id="modal-lg">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?= ucwords($this->uri->segment(3, 0)) ?> Data</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="" role="form" id="form-admin" enctype="multipart/form-data">
                <div class="modal-body">
                    <!-- form start -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>NIK <span class="symbol required"> </span></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input type="text" autocomplete="off" name="nik" id="nik" required class="form-control" placeholder="NIK">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email pribadi <span class="symbol required"> </span></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    </div>
                                    <input type="email" autocomplete="off" name="email_pribadi" required class="form-control" placeholder="Email Pribadi">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama Panggilan <span class="symbol required"> </span></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    </div>    
                                    <?php if($pegawai['kd_gugus'] == $gugus['kd_gugus']){?>
                                        <input type="text" autocomplete="off" name="email" required class="form-control" placeholder="Nama Panggilan">
                                        <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><?= $gu_web ?></span>
                                        </div>
                                    <?php } ?>
                                    <?php if($pegawai['kd_sekolah'] == $sekolah['kd_sekolah']){?>
                                        <input type="text" autocomplete="off" name="email" required class="form-control" placeholder="Nama Panggilan">
                                        <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><?= $sek_web ?></span>
                                        </div>
                                    <?php } ?>                                
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama Lengkap <span class="symbol required"> </span></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input type="text" autocomplete="off" name="nama_lengkap" required class="form-control" placeholder="Nama Lengkap">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">
                                    Tanggal Lahir <span class="symbol required"> </span>
                                </label>
                                <div class="input-group mb-3 " >
                                    <input class="form-control" type="date" id="tgl_lahir" name="tgl_lahir" required />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">
                                    Tanggal Masuk <span class="symbol required"> </span>
                                </label>
                                <div class="input-group mb-3" style="padding: 0px;">
                                    <input class="form-control" type="date" id="tgl_masuk" name="tgl_masuk" required />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Alamat <span class="symbol required"> </span></label>
                        <textarea type="text" name="alamat" class="form-control" id="alamat" placeholder="Alamat"></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Telp <span class="symbol required"> </span></label>
                                <input type="text" name="telp" class="form-control" id="telp" placeholder="Telepon">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Sekolah <span class="symbol required"> </span></label>
                                <select class="form-control select2" style="width: 100%;" id="kd_sekolah" name="kd_sekolah">
                                    <option value="">-- Sekolah --</option>
                                    <?php foreach ($data_sekolah as $ds) : ?>
                                        <option value="<?= $ds['kd_sekolah']; ?>"><?= $ds['nama_sekolah']; ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <span class="symbol required"> Harus diisi

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" id="simpan" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>