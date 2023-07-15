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
    <?php if($pegawai['kd_gugus'] == $gugus['kd_gugus']){?>
    <section class="content">
        <div class="col-12">
            <div class="card">
                <div class="tampil-modal"></div>
                <?= form_error('email', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                <div class="flash-data" data-flashdata=""><?= $this->session->flashdata('message'); ?></div>
                <div class="card-body">
                    <div class="panel-body">
                        <?php if($pegawai['kd_gugus'] == $gugus['kd_gugus']){?>
                                <button type="button" class="btn btn-primary mb-3 btn-action">
                                    <span class="fa fa-plus"></span> Tambah Data
                                </button>
                                <button type="button" class="btn btn-secondary mb-3 btn-admin">
                                    <span class="fa fa-plus"></span> Admin Sekolah
                                </button>
                                <a class="btn btn-success mb-3" href="<?= site_url('master_pegawai/data_pegawai/create') ?>"><i class="fa fa-upload"></i> Import Excel</a>
                                <a class="btn btn-primary mb-3" href="<?= site_url('master_pegawai/data_pegawai') ?>"><i class="fa fa-users"></i> Data Pegawai</a>
                        <?php } ?>
                        <?php if($pegawai['kd_sekolah'] == $sekolah['kd_sekolah']){?>
                                <button type="button" class="btn btn-primary mb-3 btn-action">
                                    <span class="fa fa-plus"></span> Tambah Data
                                </button>                               
                                <a class="btn btn-success mb-3" href="<?= site_url('master_pegawai/data_pegawai/create') ?>"><i class="fa fa-upload"></i> Import Excel</a>
                                <a class="btn btn-primary mb-3" href="<?= site_url('master_pegawai/data_pegawai') ?>"><i class="fa fa-users"></i> Data Pegawai</a>
                        <?php } ?>                        
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-sm table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">NIK</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Telp</th>
                                        <th scope="col">Email Pribadi</th>
                                        <th scope="col">Tgl Masuk</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>                       
                    </div>
                </div>
                <br>
               
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </section>
    <section class="content">
        <div class="col-12">
            <div class="card">

            <div class="card-body">
                    <div class="panel-body">                       
                        <div class="card-header"> Admin Sekolah</div>
                        <div class="table-responsive">
                            <table class="table table-borderless datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">NPSN</th>
                                        <th scope="col">NIK</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Telp</th>
                                        <th scope="col">Email Pribadi</th>
                                        <th scope="col">Tgl Masuk</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $no = 0;
                                        foreach ($data_pegawai as $dp) :
                                        $no++ ?>
                                         <tr>
                                             <td><?= $no; ?></td>
                                             <td><?= $dp['kd_sekolah'] ?></td>
                                             <td><?= $dp['nik'] ?></td>
                                             <td><?= $dp['nama_lengkap'] ?></td>
                                             <td><?= $dp['telp'] ?></td>
                                             <td>
                                                <?= $dp['email_pribadi'] ?> <br>
                                                <?= $dp['email'] ?>
                                             </td>
                                             <td>
                                                 <?php if ($dp['status'] == 1) { ?>
                                                     Aktif
                                                 <?php } else { ?>
                                                     Tidak Aktif
                                                 <?php } ?>
                                             </td>
                                             <td>     
                                                <a href="<?= base_url() . $this->uri->segment(1, 0) . $this->uri->slash_segment(2, 'both') ?>/editdata/<?= $dp['data_id'] ?>" class="btn btn-outline-warning"><i class="bi bi-pencil-square"></i> </a>                                   
                                                <a href="<?= base_url() . $this->uri->segment(1, 0) . $this->uri->slash_segment(2, 'both') ?>/delpegawai/<?= $dp['data_id'] ?>" class="btn btn-outline-danger"><i class="bi bi-trash"></i> </a>
                                             </td>
                                         </tr>
                                     <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>                       
                    </div>
                </div>

            </div>
        </div>
    </section>
    <?php } ?>
    <?php if($pegawai['kd_sekolah'] == $sekolah['kd_sekolah']){?>
    <section class="content">
        <div class="col-12">
            <div class="card">
                <div class="tampil-modal"></div>
                <?= form_error('email', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                <div class="flash-data" data-flashdata=""><?= $this->session->flashdata('message'); ?></div>
                <div class="card-body">
                    <div class="panel-body">                       
                        <?php if($pegawai['kd_sekolah'] == $sekolah['kd_sekolah']){?>
                                <button type="button" class="btn btn-primary mb-3 btn-action">
                                    <span class="fa fa-plus"></span> Tambah Data
                                </button>                               
                                <a class="btn btn-success mb-3" href="<?= site_url('master_pegawai/data_pegawai/create') ?>"><i class="fa fa-upload"></i> Import Excel</a>
                                <a class="btn btn-primary mb-3" href="<?= site_url('master_pegawai/data_pegawai') ?>"><i class="fa fa-users"></i> Data Pegawai</a>
                        <?php } ?>                        
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-sm table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">NIK</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Telp</th>
                                        <th scope="col">Email Pribadi</th>
                                        <th scope="col">Tgl Masuk</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </section>
    <?php } ?>
    
    <!-- /.content -->

</main>

<!-- jQuery -->
<script src="<?= base_url() ?>panel/plugins/jquery/jquery.min.js"></script>
