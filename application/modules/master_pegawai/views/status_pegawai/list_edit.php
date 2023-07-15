<?php defined('BASEPATH') or die("ip anda sudah tercatat oleh sistem kami") ?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1><?= $title; ?></h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href=""><?= $home; ?></a></li>                
                <li class="breadcrumb-item active"><?= $title; ?></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <!-- Main content -->
    <div class="modal-body">
        <section class="content">
            <div class="col-12">
                <div class="card">
                    <!-- Default box -->
                    <div class="modal-body">
                        <form method="post" action="<?= base_url() . $this->uri->segment(1, 0) . $this->uri->slash_segment(2, 'both') ?>updatedata" role="form" id="form-action" enctype="multipart/form-data">
                            <!-- form start -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>NIK <span class="symbol required"> </span></label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                            </div>
                                            <input type="text" autocomplete="off" name="nik" id="nik" value="<?= $data_pegawai['nik'] ?>" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nama Panggilan <span class="symbol required"> </span></label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                            </div>
                                            <input type="text" autocomplete="off" name="email" value="<?= $data_pegawai['email'] ?>" required class="form-control" readonly>
                                            <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nama Lengkap <span class="symbol required"> </span></label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                            </div>
                                            <input type="text" autocomplete="off" name="nama_pegawai" value="<?= $data_pegawai['nama_lengkap'] ?>" required class="form-control">
                                        </div>                                        
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Status Pegawai <span class="symbol required"> </span></label>
                                        <select class="form-control select2" style="width: 100%;" id="id" name="id">
                                            <option value="">-- Status Pegawai --</option>
                                            <?php foreach ($role as $ro) : ?>
                                                <option value="<?= $ro['id']; ?>"><?= $ro['role']; ?></option>
                                            <?php endforeach ?>
                                        </select>    
                                    </div>
                                </div>
                            </div>

                            <span class="symbol required"> Harus diisi

                    </div>
                    <div class="modal-footer justify-content-between">
                        <a href="<?= base_url() ?>master_pegawai/status_pegawai" class="btn btn-default">Kembali</a>
                        <button type="submit" id="simpan" class="btn btn-primary">Simpan</button>
                    </div>
                    </form>
                    <!-- /.card -->
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content -->

</main>

<!-- jQuery -->
<script src="<?= base_url() ?>panel/plugins/jquery/jquery.min.js"></script>
<!-- Datepicker -->
<script src="<?= base_url() ?>panel/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>




