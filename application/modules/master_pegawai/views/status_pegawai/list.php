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
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-sm table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">KD GUGUS</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Telp</th>
                                        <th scope="col">Email / User</th>
                                        <th scope="col">Tgl Masuk</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Ket</th>
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
    <!-- /.content -->
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
                                        <th scope="col">Nama</th>
                                        <th scope="col">Telp</th>
                                        <th scope="col">Email / User</th>
                                        <!-- <th scope="col">Tgl Masuk</th> -->
                                        <th scope="col">Status</th>
                                        <th scope="col">Ket</th>
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
                                             <td><?= $dp['nama_lengkap'] ?></td>
                                             <td><?= $dp['telp'] ?></td>
                                             <td>
                                                <?= $dp['email_pribadi'] ?> <br>
                                                <?= $dp['email'] ?>                                                
                                             </td>
                                             <!-- <td><?= $dp['tgl_masuk'] ?></td> -->
                                             <td>
                                                 <?php if ($dp['is_active'] == 1) { ?>
                                                    <i class='text-info'>User Aktif</i>
                                                 <?php } else { ?>
                                                    <i class='text-danger'>User Tidak Aktif</i>
                                                 <?php } ?>
                                             </td>
                                             <td><?= $dp['role'] ?></td>
                                             <td>     
                                                <a href="<?= base_url() . $this->uri->segment(1, 0) . $this->uri->slash_segment(2, 'both') ?>/editdata/<?= $dp['data_id'] ?>" class="btn btn-outline-success btn-sm"><i class="bi bi-person-check"></i> Proses</a>   
                                                <a href="<?= base_url() . $this->uri->segment(1, 0) . $this->uri->slash_segment(2, 'both') ?>/deldata/<?= $dp['nik'] ?>" class="btn btn-outline-danger btn-sm"><i class="bi bi-trash"></i> Hapus</a>                               
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
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-sm table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">NIK</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Telp</th>
                                        <th scope="col">Email / User</th>
                                        <th scope="col">Tgl Masuk</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Ket</th>
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

</main>

<!-- jQuery -->
<script src="<?= base_url() ?>panel/plugins/jquery/jquery.min.js"></script>
